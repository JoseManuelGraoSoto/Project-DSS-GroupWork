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
        $user = User::find($request->input('id_usuario'));
        $new_article = new Article;
        $new_article->title = $request->input('title');
        $new_article->category = $request->input('category');
        $new_article->valoration = $request->input('valoration');
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
}
