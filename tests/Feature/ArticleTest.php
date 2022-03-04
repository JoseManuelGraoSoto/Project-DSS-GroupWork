<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Model\Article;
use App\Model\User;
class ArticleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreate()
    {
        $new_user = new User([
            'name' => 'Pedro',
            'type' => 'author',
            'email' => 'pedro@gmail.com',
            'password' => 'holaContra',
            'telephone' => '966357970'
        ]);
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
