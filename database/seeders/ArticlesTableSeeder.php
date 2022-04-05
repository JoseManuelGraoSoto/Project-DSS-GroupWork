<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Article;
use DB;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articles = Article::all();

        foreach ($articles as $article) {
            $article->delete();
        }

        $new_user = new User;
        $new_user->name = 'Pedro';
        $new_user->type = 'reader';
        $new_user->email = 'pedro@gmail.com';
        $new_user->password = 'holaContra';
        $new_user->telephone = '966354870';
        $new_user->save();

        $new_article = new Article;
        $new_article->title = 'A little Title';
        $new_article->category = 'Ciencia';
        $new_article->valoration = 3.5;
        $new_article->content = 'This is an article about sciencie';
        $new_article->acepted = 1;
        $new_article->user()->associate($new_user);
        $new_article->save();
    }
}
