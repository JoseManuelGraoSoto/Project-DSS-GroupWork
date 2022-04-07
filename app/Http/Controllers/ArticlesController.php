<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;

class ArticlesController extends Controller
{
    //Devuelve la vista articleInfo pasándole como parámetro el articulo con el id requerido en la url
    public function show($id)
    {
        $article = Article::find($id);
        return view('articleInfo', ['article' => $article]);
    }

    //Devuelve la vista articlesList pasándole como parámetro todos los articulos
    public function showAll()
    {
        $articles = Article::all();
        return view('admin.article', ['articles' => $articles]);
    }

    //Devuelve el formulario de creación de Article
    public function createArticleFormulary()
    {
        return view('createArticle');
    }

    //Recibe la información de un artículo y lo añade a la base de datos
    public function create(Request $request)
    {
        $user = User::where('name', $request->input('author'))->get();
        $new_article = new Article;
        $new_article->title = $request->input('title');
        $new_article->category = $request->input('category');
        $new_article->valoration = $request->input('quantity');
        $new_article->content = $request->input('content');
        $new_article->acepted = 0;
        $new_article->user()->associate($user);
        $new_article->save();
        return view('articuloCreado');
    }

    //Devuelve el formulario de actualización de Article
    public function updateArticleFormulary()
    {
        return view('updateArticle');
    }

    //Recibe la información de un artículo y lo modifica en la base de datos
    public function update(Request $request)
    {
        $user = User::find($request->input('id_usuario'));
        $article = Article::find($request->input('article_id'));
        $article->title = $request->input('title');
        $article->category = $request->input('category');
        $article->valoration = $request->input('valoration');
        $article->content = $request->input('content');
        $article->acepted = 0;
        $article->user()->associate($user);
        $article->save();
        return 'Artículo actualizado';
    }


    //Devuelve el formulario de borrado de Article pasándole como parámetro los artículos
    public function deleteArticleFormulary()
    {
        $articles = Article::all();
        return view('deleteArticle', ['articles' => $articles]);
    }

    //Recibe un id de artículo y borra el acceso del usuario al artículo
    public function delete($id)
    {
        $article = Article::find($id);
        $title = $article->title;
        $article->delete();
        return $title . ' borrado';
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
        $nombre = $request->input('name');
        $users = User::where('name', 'LIKE', '%' . $nombre . '%')->get();
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

        $nombre = $request->input('name');
        $titulo = $request->input('title');

        $articles = null;
        if ($nombre === null && $titulo !== null) {
            if (
                $fecha !== null
            ) {
                $articles = Article::where('title', 'LIKE', '%' . $titulo . '%')->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->get();
            } else {
                $articles = Article::where('title', 'LIKE', '%' . $titulo . '%')->get();
            }
        } elseif ($nombre !== null && $titulo === null) {
            if ($fecha !== null) {
                $articles = Article::whereIn('user_id', $ids)->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->get();
            } else {
                $articles = Article::where('name', 'LIKE', '%' . $nombre . '%')->whereIn('user_id', $ids)->get();
            }
        } elseif ($nombre !== null && $titulo !== null) {
            if ($fecha !== null) {
                $articles = Article::where('title', 'LIKE', '%' . $titulo . '%')->whereIn('user_id', $ids)->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->get();
            } else {
                $articles = Article::where('title', 'LIKE', '%' . $titulo . '%')->whereIn('user_id', $ids)->get();
            }
        } else {
            if ($fecha !== null) {
                $articles = Article::where('title', 'LIKE', '%' . $titulo . '%')->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->get();
            } else {
                $articles = Article::where('title', 'LIKE', '%' . $titulo . '%')->get();
            }
        }
        $articles = $articles->unique();


        if ($request->has('order')) {
            $articles = $articles->sortByDesc('id');
        } else {
            $articles = $articles->sortBy('id');
        }
        return view('admin.article', ['articles' => $articles]);
    }
}
