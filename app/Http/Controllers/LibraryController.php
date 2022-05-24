<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reward;
use App\Models\Article;
use App\Models\User;
use DB;

class LibraryController extends Controller
{

    public function showAll()
    {
        $articles = Article::select('articles.title', 'articles.content', DB::raw('AVG(valorations.value) as value'), 'users.name')->leftjoin('valorations', 'valorations.article_id', '=', 'articles.id')->leftjoin('users', 'users.id', '=', 'articles.user_id')->where('acepted', 1)->groupby('articles.id')->paginate(7);
        return view('common.library', ['articles' => $articles]);
    }

    public function search(Request $request)
    {
        $name = $request->input('author');
        $users = User::where('name', 'LIKE', '%' . $name . '%')->get();
        $ids = [];
        foreach ($users as $users) {
            $ids[] = $users->id;
        }
        $titulo = $request->input('title');

        $articles = null;
        if ($name === null && $titulo !== null) {
            $articles = Article::select('articles.title', 'articles.content', DB::raw('AVG(valorations.value) as value'), 'users.name')->leftjoin('valorations', 'valorations.article_id', '=', 'articles.id')->leftjoin('users', 'users.id', '=', 'articles.user_id')->where('title', 'LIKE', '%' . $titulo . '%')->where('acepted', 1)->groupby('articles.id')->paginate(7)->withQueryString();;
        } elseif ($name !== null && $titulo === null) {
            $articles = Article::select('articles.title', 'articles.content', DB::raw('AVG(valorations.value) as value'), 'users.name')->leftjoin('valorations', 'valorations.article_id', '=', 'articles.id')->leftjoin('users', 'users.id', '=', 'articles.user_id')->whereIn('articles.user_id', $ids)->where('acepted', 1)->groupby('articles.id')->paginate(7)->withQueryString();
        } else {
            $articles = Article::select('articles.title', 'articles.content', DB::raw('AVG(valorations.value) as value'), 'users.name')->leftjoin('valorations', 'valorations.article_id', '=', 'articles.id')->leftjoin('users', 'users.id', '=', 'articles.user_id')->where('title', 'LIKE', '%' . $titulo . '%')->where('acepted', 1)->whereIn('articles.user_id', $ids)->where('acepted', 1)->groupby('articles.id')->paginate(7)->withQueryString();
        }
        return view('common.library', ['articles' => $articles]);
    }
}
