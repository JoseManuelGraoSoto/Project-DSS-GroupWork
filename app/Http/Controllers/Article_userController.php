<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article_user;
use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Facades\Validator;

class Article_userController extends Controller
{
    // Devuelve la vista articles_userList pasándole como parámetro todos los usuarios
    public function showAll()
    {
        $articles_user = Article_user::paginate(7);
        return view('admin.userAccessArticle', ['articles_user' => $articles_user]);
    }

    // Devuelve el formulario de creación de article_user pasándole como parámetros tanto los usuarios como los artículos existentes
    public function createArticle_userFormulary()
    {
        $users = User::all();
        $articles = Article::all();
        return view('createArticle_user', ['users' => $users, 'articles' => $articles]);
    }

    // Recibe un id de artículo y un id de usuario y crea un acceso del usuario al artículo
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // Cambiar id si luego se cambian a otras cosas
            'article_id' => 'required|exists:articles,id',
            'user_id' => 'required|exists:users,id'
            // Falta de terminar
        ]);

        if ($validator->fails()) {
            return redirect(route('article.createForm'))
                ->withErrors($validator)
                ->withInput();
        }

        $inputs = $validator->validated();
        $article_user = Article::find($inputs['article_id']);
        $article_user->access()->attach($inputs['user_id']);
        $article_user->save();
        return view('article_userCreado');
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
        $descendente = $request->has('order');
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
                if ($fecha[$j] === ' ') {
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

        $types = array('reader', 'author', 'moderator', 'administrator');
        if ($request->has('readerCheckbox') || $request->has('authorCheckbox') || $request->has('moderatorCheckbox') || $request->has('administratorCheckbox')) {
            $types = array();
        }
        if ($request->has('readerCheckbox')) {
            $types[] = 'reader';
        }
        if ($request->has('authorCheckbox')) {
            $types[] = 'author';
        }
        if ($request->has('moderatorCheckbox')) {
            $types[] = 'moderator';
        }
        if ($request->has('administratorCheckbox')) {
            $types[] = 'administrator';
        }

        $title = $request->input('title');
        $email = $request->input('author');

        $articles_user = null;
        $users = null;
        $articles = null;
        if ($title === null && $email !== null && !empty($types)) {
            if ($fecha !== null) {
                if ($descendente) {
                    $articles_user = Article_user::join('articles', 'articles.id', '=', 'article_user.article_id')->join('users', 'users.id', '=', 'article_user.user_id')->where('users.email', 'LIKE', '%' . $email . '%')->whereIn('users.type', $types)->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id', 'desc')->paginate($perPage = 7, $columns = ['article_user.id', 'article_user.article_id', 'article_user.user_id', 'article_user.created_at', 'users.name', 'users.email', 'users.type', 'articles.title'])->withQueryString();
                } else {
                    $articles_user = Article_user::join('articles', 'articles.id', '=', 'article_user.article_id')->join('users', 'users.id', '=', 'article_user.user_id')->where('users.email', 'LIKE', '%' . $email . '%')->whereIn('users.type', $types)->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id')->paginate($perPage = 7, $columns = ['article_user.id', 'article_user.article_id', 'article_user.user_id', 'article_user.created_at', 'users.name', 'users.email', 'users.type', 'articles.title'])->withQueryString();
                }
            } else {
                if ($descendente) {

                    $articles_user = Article_user::join('articles', 'articles.id', '=', 'article_user.article_id')->join('users', 'users.id', '=', 'article_user.user_id')->where('users.email', 'LIKE', '%' . $email . '%')->whereIn('users.type', $types)->orderBy('id', 'desc')->paginate($perPage = 7, $columns = ['article_user.id', 'article_user.article_id', 'article_user.user_id', 'article_user.created_at', 'users.name', 'users.email', 'users.type', 'articles.title'])->withQueryString();
                } else {
                    $articles_user = Article_user::join('articles', 'articles.id', '=', 'article_user.article_id')->join('users', 'users.id', '=', 'article_user.user_id')->where('users.email', 'LIKE', '%' . $email . '%')->whereIn('users.type', $types)->orderBy('id')->paginate($perPage = 7, $columns = ['article_user.id', 'article_user.article_id', 'article_user.user_id', 'article_user.created_at', 'users.name', 'users.email', 'users.type', 'articles.title'])->withQueryString();
                }
            }
        } elseif ($title !== null && $email === null && !empty($types)) {
            if ($fecha !== null) {
                if ($descendente) {

                    $articles_user = Article_user::join('articles', 'articles.id', '=', 'article_user.article_id')->join('users', 'users.id', '=', 'article_user.user_id')->where('articles.title', 'LIKE', '%' . $title . '%')->whereIn('users.type', $types)->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id', 'desc')->paginate($perPage = 7, $columns = ['article_user.id', 'article_user.article_id', 'article_user.user_id', 'article_user.created_at', 'users.name', 'users.email', 'users.type', 'articles.title'])->withQueryString();
                } else {
                    $articles_user = Article_user::join('articles', 'articles.id', '=', 'article_user.article_id')->join('users', 'users.id', '=', 'article_user.user_id')->where('articles.title', 'LIKE', '%' . $title . '%')->whereIn('users.type', $types)->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id')->paginate($perPage = 7, $columns = ['article_user.id', 'article_user.article_id', 'article_user.user_id', 'article_user.created_at', 'users.name', 'users.email', 'users.type', 'articles.title'])->withQueryString();
                }
            } else {
                if ($descendente) {

                    $articles_user = Article_user::join('articles', 'articles.id', '=', 'article_user.article_id')->join('users', 'users.id', '=', 'article_user.user_id')->where('articles.title', 'LIKE', '%' . $title . '%')->whereIn('users.type', $types)->orderBy('id', 'desc')->paginate($perPage = 7, $columns = ['article_user.id', 'article_user.article_id', 'article_user.user_id', 'article_user.created_at', 'users.name', 'users.email', 'users.type', 'articles.title'])->withQueryString();
                } else {
                    $articles_user = Article_user::join('articles', 'articles.id', '=', 'article_user.article_id')->join('users', 'users.id', '=', 'article_user.user_id')->where('articles.title', 'LIKE', '%' . $title . '%')->whereIn('users.type', $types)->orderBy('id')->paginate($perPage = 7, $columns = ['article_user.id', 'article_user.article_id', 'article_user.user_id', 'article_user.created_at', 'users.name', 'users.email', 'users.type', 'articles.title'])->withQueryString();
                }
            }
        } elseif ($title === null && $email === null && !empty($types)) {
            if ($fecha !== null) {
                if ($descendente) {

                    $articles_user = Article_user::join('articles', 'articles.id', '=', 'article_user.article_id')->join('users', 'users.id', '=', 'article_user.user_id')->whereIn('users.type', $types)->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id', 'desc')->paginate($perPage = 7, $columns = ['article_user.id', 'article_user.article_id', 'article_user.user_id', 'article_user.created_at', 'users.name', 'users.email', 'users.type', 'articles.title'])->withQueryString();
                } else {
                    $articles_user = Article_user::join('articles', 'articles.id', '=', 'article_user.article_id')->join('users', 'users.id', '=', 'article_user.user_id')->whereIn('users.type', $types)->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id')->paginate($perPage = 7, $columns = ['article_user.id', 'article_user.article_id', 'article_user.user_id', 'article_user.created_at', 'users.name', 'users.email', 'users.type', 'articles.title'])->withQueryString();
                }
            } else {
                if ($descendente) {
                    $articles_user = Article_user::join('articles', 'articles.id', '=', 'article_user.article_id')->join('users', 'users.id', '=', 'article_user.user_id')->whereIn('users.type', $types)->orderBy('id', 'desc')->paginate($perPage = 7, $columns = ['article_user.id', 'article_user.article_id', 'article_user.user_id', 'article_user.created_at', 'users.name', 'users.email', 'users.type', 'articles.title'])->withQueryString();
                } else {
                    $articles_user = Article_user::join('articles', 'articles.id', '=', 'article_user.article_id')->join('users', 'users.id', '=', 'article_user.user_id')->whereIn('users.type', $types)->orderBy('id')->paginate($perPage = 7, $columns = ['article_user.id', 'article_user.article_id', 'article_user.user_id', 'article_user.created_at', 'users.name', 'users.email', 'users.type', 'articles.title'])->withQueryString();
                }
            }
        } else {
            if ($fecha !== null) {
                if ($descendente) {

                    $articles_user = Article_user::join('articles', 'articles.id', '=', 'article_user.article_id')->join('users', 'users.id', '=', 'article_user.user_id')->where('articles.title', 'LIKE', '%' . $title . '%')->where('users.email', 'LIKE', '%' . $email . '%')->whereIn('users.type', $types)->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id', 'desc')->paginate($perPage = 7, $columns = ['article_user.id', 'article_user.article_id', 'article_user.user_id', 'article_user.created_at', 'users.name', 'users.email', 'users.type', 'articles.title'])->withQueryString();
                } else {
                    $articles_user = Article_user::join('articles', 'articles.id', '=', 'article_user.article_id')->join('users', 'users.id', '=', 'article_user.user_id')->where('articles.title', 'LIKE', '%' . $title . '%')->where('users.email', 'LIKE', '%' . $email . '%')->whereIn('users.type', $types)->whereBetween('created_at', [$fecha . ' 00:00:00', $fecha . ' 23:59:59'])->orderBy('id')->paginate($perPage = 7, $columns = ['article_user.id', 'article_user.article_id', 'article_user.user_id', 'article_user.created_at', 'users.name', 'users.email', 'users.type', 'articles.title'])->withQueryString();
                }
            } else {
                if ($descendente) {

                    $articles_user = Article_user::join('articles', 'articles.id', '=', 'article_user.article_id')->join('users', 'users.id', '=', 'article_user.user_id')->where('articles.title', 'LIKE', '%' . $title . '%')->where('users.email', 'LIKE', '%' . $email . '%')->whereIn('users.type', $types)->orderBy('id', 'desc')->paginate($perPage = 7, $columns = ['article_user.id', 'article_user.article_id', 'article_user.user_id', 'article_user.created_at', 'users.name', 'users.email', 'users.type', 'articles.title'])->withQueryString();
                } else {
                    $articles_user = Article_user::join('articles', 'articles.id', '=', 'article_user.article_id')->join('users', 'users.id', '=', 'article_user.user_id')->where('articles.title', 'LIKE', '%' . $title . '%')->where('users.email', 'LIKE', '%' . $email . '%')->whereIn('users.type', $types)->orderBy('id')->paginate($perPage = 7, $columns = ['article_user.id', 'article_user.article_id', 'article_user.user_id', 'article_user.created_at', 'users.name', 'users.email', 'users.type', 'articles.title'])->withQueryString();
                }
            }
        }

        return view('admin.userAccessArticle', compact('articles_user')); //['articles_user' => $articles_user]);
    }

    public function delete(Request $request)
    {
        $selected = json_decode($request->input('access'));

        foreach ($selected as $id) {
            $access = Article_user::find($id);
            $access->delete();
        }

        return back()->withInput();
    }
}
