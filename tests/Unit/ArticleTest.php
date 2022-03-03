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

    public function testCreate(){
        $new_article = new Article;
        $new_article->title = 'Test Article Insert';
        $new_article->category = 'Biologia';
        $new_article->valoration = 1.5;
        $new_article->content = 'Testing article insert';
        $new_article->acepted = 0;
        $new_article->user_id = 1;
        $new_article->save();

        $article = Article::where('title', 'Test Article Insert')-> first(); // select * from articles where title = 'Test Article Insert'
        $this->assertEquals($new_article->title, $article->title);
    }

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
        $num_article = Article::all()->count();
        $article = Article::find(1);
        $article->delete();
        $num_article_deleted = Article::all()->count();
        $this->assertTrue($num_article > $num_article_deleted);
    }
}
