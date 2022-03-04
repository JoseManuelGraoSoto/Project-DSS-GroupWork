<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Article;
use App\Models\User;
class ArticleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreate()
    {
        $new_user = new User;
        $new_user->name = 'Pedro';
        $new_user->type = 'reader';
        $new_user->email = 'pedro@gmail.com';
        $new_user->password = 'holaContra';
        $new_user->telephone = '966354870';
        $new_user->save();        
        $new_article = new Article;
        $new_article->title = 'Test Article Insert';
        $new_article->category = 'Biologia';
        $new_article->valoration = 1.5;
        $new_article->content = 'Testing article insert';
        $new_article->acepted = 0;
        $new_article->user()->associate($new_user);
        $new_article->save();

        $this->assertEquals($new_article->user_id, $new_user->id);
    }
}
