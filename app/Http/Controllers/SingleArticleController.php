<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use App\Models\Valoration;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Auth;

class SingleArticleController extends Controller
{
    // Obtener datos del artículo
    public function getArticle(Request $request, $id)
    {
        $article = Article::find($id);
        $valoration = Valoration::where('article_id', $id)->where('user_id', Auth::user()->id)->first();
        return view('common.article', ['article' => $article, 'valoration' => $valoration]);
    }

    public function acceptArticle(Request $request, $id) {
        $new_article = Article::find($id);
        $new_article->acepted = 1;
        $new_article->save();
        return back();
    }

    public function updateValoration(Request $request, $id) {
        $valoration = Valoration::where('article_id', $id)->where('user_id', Auth::user()->id)->first();
        $valoration->value = ($request->input('star') == null) ? 0 : $request->input('star');
        $valoration->save();
        return back();
    }

    public function createValoration(Request $request, $id) {
        $valoration = new Valoration();
        $valoration->value = ($request->input('star') == null) ? 0 : $request->input('star');
        $valoration->user_id = Auth::user()->id;
        $valoration->article_id =$id;
        // Hay que quitar lo siguiente
        $valoration->comment = "";
        $valoration->isModerator = 0;
        $valoration->save();
        return back();
    }
}
