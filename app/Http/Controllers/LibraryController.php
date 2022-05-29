<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use DB;

class LibraryController extends Controller
{
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

        $inputs = $request->all();

        $states = null;

        if (Auth::user()->type == 'moderator') {
            if ($request->has('state')) {
                $states = $inputs['state'];
            }
            if ($name === null && $titulo !== null) {
                if ($states !== null) {
                    $articles = Article::select('articles.id', 'articles.title', 'articles.content', DB::raw('AVG(valorations.value) as value'), 'users.name')->leftjoin('valorations', 'valorations.article_id', '=', 'articles.id')->leftjoin('users', 'users.id', '=', 'articles.user_id')->where('title', 'LIKE', '%' . $titulo . '%')->whereIn('articles.acepted', $states)->groupby('articles.id')->paginate(7)->withQueryString();;
                } else {
                    $articles = Article::select('articles.id', 'articles.title', 'articles.content', DB::raw('AVG(valorations.value) as value'), 'users.name')->leftjoin('valorations', 'valorations.article_id', '=', 'articles.id')->leftjoin('users', 'users.id', '=', 'articles.user_id')->where('title', 'LIKE', '%' . $titulo . '%')->groupby('articles.id')->paginate(7)->withQueryString();;
                }
            } elseif ($name !== null && $titulo === null) {
                if ($states !== null) {
                    $articles = Article::select('articles.id', 'articles.title', 'articles.content', DB::raw('AVG(valorations.value) as value'), 'users.name')->leftjoin('valorations', 'valorations.article_id', '=', 'articles.id')->leftjoin('users', 'users.id', '=', 'articles.user_id')->whereIn('articles.user_id', $ids)->whereIn('articles.acepted', $states)->groupby('articles.id')->paginate(7)->withQueryString();
                } else {
                    $articles = Article::select('articles.id', 'articles.title', 'articles.content', DB::raw('AVG(valorations.value) as value'), 'users.name')->leftjoin('valorations', 'valorations.article_id', '=', 'articles.id')->leftjoin('users', 'users.id', '=', 'articles.user_id')->whereIn('articles.user_id', $ids)->groupby('articles.id')->paginate(7)->withQueryString();
                }
            } else {
                if ($states !== null) {
                    $articles = Article::select('articles.id', 'articles.title', 'articles.content', DB::raw('AVG(valorations.value) as value'), 'users.name')->leftjoin('valorations', 'valorations.article_id', '=', 'articles.id')->leftjoin('users', 'users.id', '=', 'articles.user_id')->where('title', 'LIKE', '%' . $titulo . '%')->whereIn('articles.user_id', $ids)->whereIn('articles.acepted', $states)->groupby('articles.id')->paginate(7)->withQueryString();
                } else {
                    $articles = Article::select('articles.id', 'articles.title', 'articles.content', DB::raw('AVG(valorations.value) as value'), 'users.name')->leftjoin('valorations', 'valorations.article_id', '=', 'articles.id')->leftjoin('users', 'users.id', '=', 'articles.user_id')->where('title', 'LIKE', '%' . $titulo . '%')->whereIn('articles.user_id', $ids)->groupby('articles.id')->paginate(7)->withQueryString();
                }
            }
        } else {
            if ($name === null && $titulo !== null) {
                $articles = Article::select('articles.id', 'articles.title', 'articles.content', DB::raw('AVG(valorations.value) as value'), 'users.name')->leftjoin('valorations', 'valorations.article_id', '=', 'articles.id')->leftjoin('users', 'users.id', '=', 'articles.user_id')->where('title', 'LIKE', '%' . $titulo . '%')->where('acepted', 1)->groupby('articles.id')->paginate(7)->withQueryString();;
            } elseif ($name !== null && $titulo === null) {
                $articles = Article::select('articles.id', 'articles.title', 'articles.content', DB::raw('AVG(valorations.value) as value'), 'users.name')->leftjoin('valorations', 'valorations.article_id', '=', 'articles.id')->leftjoin('users', 'users.id', '=', 'articles.user_id')->whereIn('articles.user_id', $ids)->where('acepted', 1)->groupby('articles.id')->paginate(7)->withQueryString();
            } else {
                $articles = Article::select('articles.id', 'articles.title', 'articles.content', DB::raw('AVG(valorations.value) as value'), 'users.name')->leftjoin('valorations', 'valorations.article_id', '=', 'articles.id')->leftjoin('users', 'users.id', '=', 'articles.user_id')->where('title', 'LIKE', '%' . $titulo . '%')->where('acepted', 1)->whereIn('articles.user_id', $ids)->where('acepted', 1)->groupby('articles.id')->paginate(7)->withQueryString();
            }
        }

        return view('common.library', ['articles' => $articles]);
    }
}
