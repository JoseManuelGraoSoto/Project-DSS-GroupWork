<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reward;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome.landingpage');
    }

    public function loadContent()
    {
        $articles = Article::select('articles.title', 'articles.content', 'articles.id', 'articles.created_at', DB::raw('AVG(valorations.value) as value'), 'users.name')->leftjoin('valorations', 'valorations.article_id', '=', 'articles.id')->leftjoin('users', 'users.id', '=', 'articles.user_id')->where('guestAccessible', 1)->where('acepted', 1)->groupby('articles.id')->get();
        $rewardsAuthors = Reward::select('rewards.points', 'users.name')->leftjoin('users', 'rewards.user_id', '=', 'users.id')->where('isModerator', 0)->whereYear('rewards.created_at', date('Y'))->whereMonth('rewards.created_at', date('m'))->orderByDesc('points')->limit(20)->get();
        $rewardsModerators = Reward::select('rewards.points', 'users.name')->leftjoin('users', 'users.id', '=', 'rewards.user_id')->where('isModerator', 1)->whereYear('rewards.created_at', date('Y'))->whereMonth('rewards.created_at', date('m'))->orderByDesc('points')->limit(20)->get();
        error_log($rewardsAuthors);
        return view('welcome.landingpage', ['articles' => $articles, 'rewardsAuthors' => $rewardsAuthors, 'rewardsModerators' => $rewardsModerators]);
    }
}
