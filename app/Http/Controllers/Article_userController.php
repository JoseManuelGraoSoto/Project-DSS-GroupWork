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
