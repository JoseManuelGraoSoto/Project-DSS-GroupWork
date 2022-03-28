<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticlesController extends Controller
{
    //Devuelve la vista articleInfo pasándole como parámetro el articulo con el id requerido en la url
    public function show($id) {
        $article = Article::find($id);
        return view('articleInfo', ['article' => $article]);
    }

    //Devuelve la vista articlesList pasándole como parámetro todos los articulos
    public function showAll(){
        $articles = Article::all();
        return view('articlesList', ['articles' => $articles]);
    }

    public function deleteArticleFormulary(){
        $articles = Article::all();
        return view('deleteArticle', ['articles' => $articles]);
    }

    public function delete($id){
        $article = Article::find($id);
        $title = $article->title;
        $article->delete();
        return $title . ' borrado';
    }
}
