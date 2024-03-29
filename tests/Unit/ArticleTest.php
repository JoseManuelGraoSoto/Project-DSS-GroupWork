<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Article;

class ArticleTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function testRead()
    {
        $article = Article::find(1); // select * from articles where id = 1
        $this->assertEquals($article->title, 'A little Title');
    }

    public function testUpdate(){
        $article = Article::find(1);
        $article->valoration = 4.0;
        $article->save();

        $updated_article = Article::find(1);
        $this->assertEquals($updated_article->valoration, 4.0);
    }

    public function testDelete(){
        $new_article = new Article;
        $new_article->title = 'Test Article Delete';
        $new_article->category = 'Computación';
        $new_article->valoration = 2.3;
        $new_article->content = 'Testing article delete';
        $new_article->acepted = 1;
        $new_article->user_id = 1;
        $new_article->save();

        $num_article = Article::all()->count();
        $article = Article::where('title','Test Article Delete')->firstOrFail();
        $article->delete();
        $num_article_deleted = Article::all()->count();
        $this->assertTrue($num_article > $num_article_deleted);
    }
}
