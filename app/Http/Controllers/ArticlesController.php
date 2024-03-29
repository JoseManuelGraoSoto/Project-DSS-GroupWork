<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

use DB;

class ArticlesController extends Controller
{
    const LOCATION = "storage/app/public/articles/";
    const GUARDAR = "public/articles/";
    // Devuelve la vista articlesList pasándole como parámetro todos los articulos
    public function showAll()
    {
        $articles = Article::paginate(7);
        return view('admin.article', ['articles' => $articles]);
    }

    public function showAccessibleArticles()
    {
        $articles = Article::select('articles.title', 'articles.content', 'articles.id', 'articles.created_at', DB::raw('AVG(valorations.value) as value'), 'users.name')->leftjoin('valorations', 'valorations.article_id', '=', 'articles.id')->leftjoin('users', 'users.id', '=', 'articles.user_id')->where('guestAccessible', 1)->where('acepted', 1)->groupby('articles.id')->get();
        return view('welcome.landingpage', ['articles' => $articles]);
    }

    // Devuelve el formulario de creación de Article
    public function createArticleFormulary()
    {
        return view('admin.add.createArticle');
    }

    // Recibe la información de un artículo y lo añade a la base de datos
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            // Cambiar a email en vez de nombre?
            'author' => 'required|exists:users,email',
            'category' => 'required',
            'selec-txt' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect(route('article.createForm'))
                ->withErrors($validator)
                ->withInput();
        }

        $inputs = $validator->validated();
        $img = $inputs['selec-txt'];
        if ($img == null) {
            $nombreImagen = "prueba.pdf";
        } else {
            $nombreImagen = $img->getClientOriginalName();
            \Storage::disk('local')->put(self::GUARDAR . $nombreImagen, \File::get($img));
        }
        $user = User::where('email', $inputs['author'])->firstOrFail();
        $categoria = $inputs['category'];
        $categoria2 = Category::where('category', $categoria)->firstOrFail();
        $new_article = new Article;
        $new_article->title = $inputs['title'];
        $new_article->category = $categoria;
        $new_article->pdf_path = $nombreImagen;
        $new_article->content = 'Contenido de prueba'; //$request->input('content');
        $new_article->acepted = $request->has('accepted');
        $new_article->guestAccessible = 0;
        $new_article->category_id = $categoria2->id;
        $new_article->user()->associate($user);
        $new_article->save();
        return redirect()->action([ArticlesController::class, 'search'])->withInput();
    }


    // Devuelve el formulario de actualización de Article
    public function updateArticleFormulary(Request $request)
    {
        $article = Article::find($request->input('article_id'));
        return view('admin.add.updateArticle', ['article' => $article]);
    }

    // Recibe la información de un artículo y lo modifica en la base de datos
    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            // Cambiar a email en vez de nombre?
            'author' => 'required|exists:users,email',
            'selec-txt' => 'required',
            'category' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect(route('article.updateForm'))
                ->withErrors($validator)
                ->withInput();
        }
        $inputs = $validator->validated();
        $img = $inputs['selec-txt'];
        if ($img == null) {
            $nombreImagen = "prueba.pdf";
        } else {
            $nombreImagen = $img->getClientOriginalName();
            \Storage::disk('local')->put(self::GUARDAR . $nombreImagen, \File::get($img));
        }
        $categoria = $inputs['category'];
        $categoria2 = Category::where('category', $categoria)->firstOrFail();
        $user = User::where('email', $inputs['author'])->firstOrFail();
        $new_article = Article::find($request->input('article_id'));
        $new_article->title = $inputs['title'];
        $new_article->category = $categoria;
        $new_article->pdf_path = $nombreImagen;
        $new_article->content = 'Contenido de prueba'; //$request->input('content');
        $new_article->acepted = $request->has('accepted');
        $new_article->guestAccessible = 0;
        $new_article->category_id = $categoria2->id;
        $new_article->user()->associate($user);
        $new_article->save();
        return redirect()->action([ArticlesController::class, 'search'])->withInput();
    }

    public function extraerMes($mes)
    {
        switch ($mes) {
            case 'Enero':
                return '01';
            case 'Febrero':
                return '02';
            case 'Marzo':
                return '03';
            case 'Abril':
                return '04';
            case 'Mayo':
                return '05';
            case 'Junio':
                return '06';
            case 'Julio':
                return '07';
            case 'Agosto':
                return '08';
            case 'Septiembre':
                return '09';
            case 'Octubre':
                return '10';
            case 'Noviembre':
                return '11';
            case 'Diciembre':
                return '12';
        }
    }

    public function search(Request $request)
    {
        $email = $request->input('author');
        $users = User::where('email', 'LIKE', '%' . $email . '%')->get();
        $ids = [];
        foreach ($users as $users) {
            $ids[] = $users->id;
        }
        $titulo = $request->input('title');
        $fecha = $request->input('datepicker');
        $dia = '';
        $mes = '';
        $anyo = '';
        if ($fecha !== null) {
            $j = 0;
            for ($j = 0; $j < strlen($fecha); $j++) {
                if ($fecha[$j] === ' ') {
                    $j++;
                    break;
                }
            }
            $dia = $fecha[$j] . $fecha[$j + 1];
            $j += 3;
            $mes = '';
            for ($j; $j < strlen($fecha); $j++) {
                if (
                    $fecha[$j] === ' '
                ) {
                    $j++;
                    break;
                } else {
                    $mes .= $fecha[$j];
                }
            }
            $mes = $this->extraerMes($mes);
            $anyo = $fecha[$j] . $fecha[$j + 1] . $fecha[$j + 2] . $fecha[$j + 3];

            $fecha = $anyo . '-' . $mes . '-' . $dia;
        }

        $descendente = $request->has('order');

        $articles = null;
        if ($email === null && $titulo !== null) {
            if (
                $fecha !== null
            ) {
                if ($descendente) {
                    $articles = Article::where('title', 'LIKE', '%' . $titulo . '%')->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id', 'desc')->paginate(7)->withQueryString();
                } else {
                    $articles = Article::where('title', 'LIKE', '%' . $titulo . '%')->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id')->paginate(7)->withQueryString();
                }
            } else {
                if ($descendente) {
                    $articles = Article::where('title', 'LIKE', '%' . $titulo . '%')->orderBy('id', 'desc')->paginate(7)->withQueryString();;
                } else {
                    $articles = Article::where('title', 'LIKE', '%' . $titulo . '%')->orderBy('id')->paginate(7)->withQueryString();;
                }
            }
        } elseif ($email !== null && $titulo === null) {
            if ($fecha !== null) {
                if ($descendente) {
                    $articles = Article::whereIn('user_id', $ids)->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id', 'desc')->paginate(7)->withQueryString();
                } else {
                    $articles = Article::whereIn('user_id', $ids)->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id')->paginate(7)->withQueryString();
                }
            } else {
                if ($descendente) {
                    $articles = Article::whereIn('user_id', $ids)->orderBy('id', 'desc')->paginate(7)->withQueryString();
                } else {
                    $articles = Article::whereIn('user_id', $ids)->orderBy('id')->paginate(7)->withQueryString();
                }
            }
        } else {
            if ($fecha !== null) {
                if ($descendente) {
                    $articles = Article::where('title', 'LIKE', '%' . $titulo . '%')->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orWhereIn('user_id', $ids)->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id', 'desc')->paginate(7)->withQueryString();
                } else {
                    $articles = Article::where('title', 'LIKE', '%' . $titulo . '%')->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orWhereIn('user_id', $ids)->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id')->paginate(7)->withQueryString();
                }
            } else {
                if ($descendente) {
                    $articles = Article::where('title', 'LIKE', '%' . $titulo . '%')->orWhereIn('user_id', $ids)->orderBy('id', 'desc')->paginate(7)->withQueryString();
                } else {
                    $articles = Article::where('title', 'LIKE', '%' . $titulo . '%')->orWhereIn('user_id', $ids)->orderBy('id')->paginate(7)->withQueryString();
                }
            }
        }
        //$articles = $articles->unique();
        return view('admin.article', ['articles' => $articles]);
    }

    public function delete(Request $request)
    {
        $articles = json_decode($request->input('articles'));

        foreach ($articles as $id) {
            $article = Article::find($id);
            $article->delete();
        }

        return back()->withInput();
    }

    public function volver()
    {
        return redirect()->action([ArticlesController::class, 'search'])->withInput();
    }
}
