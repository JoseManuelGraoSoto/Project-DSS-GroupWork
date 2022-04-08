<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Models\User;
use App\Models\Article;


class Article_userTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        foreach ($users as $user) {
            $articles = $user->articles();
            foreach ($articles as $article) {
                $user->access()->detach($article->id);
            }
        }

        $user = User::find(2);
        $article = Article::find(1);
        $article->access()->attach($user->id);
        $article->save();
    }
}
