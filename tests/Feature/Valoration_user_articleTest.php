<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Article;
use App\Models\Valoration;

class Valoration_user_articleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {        
        $new_user = User::where('name','Pedro')-> first(); 
        $new_article = Article::where('category','Biologia')-> first(); 

        $new_Valoration= new Valoration;
        $new_Valoration->value = 4;
        $new_Valoration->comment = 'Todo perfecto, mucho texto';
        $new_Valoration->isModerator = true;
        $new_Valoration->article_id = 3;
        $new_Valoration->user_id = 4;
        $new_Valoration->save();

        $new_Valoration->user()->associate($new_user);
        $new_Valoration->article()->associate($new_article);
        $new_Valoration->save();
        $this->assertEquals($new_article->id, $new_Valoration->article_id);


    }
}
