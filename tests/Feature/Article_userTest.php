<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Article;
use App\Models\Article_user;

class Article_userTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreate()
    {
        $new_user = new User;
        $new_user->name = 'Carlos';
        $new_user->type = 'reader';
        $new_user->email = 'carlos@gmail.com';
        $new_user->password = 'contraseña';
        $new_user->telephone = '966358945';
        $new_user->save();

        $new_article = new Article;
        $new_article->title = 'Test access to article';
        $new_article->category = 'Machine Learning';
        $new_article->valoration = 4.9;
        $new_article->content = 'Test access to article';
        $new_article->acepted = 1;
        $new_article->user_id = 2;
        $new_article->save();
        
        $new_article->access()->attach($new_user->id);
        $article_user = Article::find($new_article->id)->access->find($new_user->id);
        $accessBy = User::where('email','carlos@gmail.com')->first();

        $this->assertEquals($article_user->id, $accessBy->id);
    }
}
