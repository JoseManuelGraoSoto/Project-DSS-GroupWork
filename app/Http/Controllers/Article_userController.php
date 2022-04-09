<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article_user;
use App\Models\User;
use App\Models\Article;




class Article_userController extends Controller
{
    //Devuelve la vista articleInfo pasándole como parámetro el articulo con el id requerido en la url
    public function show($id)
    {
        $article_user = User::find($id)->access;
        return view('article_userInfo', ['article_user' => $article_user]);
    }

    //Devuelve la vista articles_userList pasándole como parámetro todos los usuarios
    public function showAll()
    {
        $articles_user = User::paginate(7);
        return view('admin.userAccessArticle', ['articles_user' => $articles_user]);
        // $articles_user = User::all();
        // return view('admin.userAccessArticle', ['articles_user' => $articles_user]);
    }

    //Devuelve el formulario de creación de article_user pasándole como parámetros tanto los usuarios como los artículos existentes
    public function createArticle_userFormulary()
    {
        $users = User::all();
        $articles = Article::all();
        return view('createArticle_user', ['users' => $users, 'articles' => $articles]);
    }

    //Recibe un id de artículo y un id de usuario y crea un acceso del usuario al artículo
    public function create(Request $request)
    {
        $article_user = Article::find($request->input('article_id'));
        $article_user->access()->attach($request->input('user_id'));
        $article_user->save();
        return view('article_userCreado');
    }

    //Devuelve el formulario de borrado de article_user pasándole como parámetro los usuarios
    public function deleteArticle_userFormulary()
    {
        $users = User::all();
        return view('deleteArticle_user', ['users' => $users]);
    }

    //Recibe un id de artículo y un id de usuario y borra el acceso del usuario al artículo
    public function delete(Request $request)
    {
        $user = User::find($request->input('user_id'));
        $article = Article::find($request->input('article_id'));
        $mensaje = 'Acceso del usuario ' . $user->name . ' al artículo ' . $article->title;
        $user->access()->detach($article->id);
        return $mensaje;
    }
}
