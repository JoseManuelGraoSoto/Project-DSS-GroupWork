<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class ArticleTest extends TestCase {
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreate(){
        $new_user = new User;
        $new_user->name = 'David';
        $new_user->type = 'Lector';
        $new_user->email = "david@gmail.com";
        $new_user->email_verified_at = "david@gmail.com";
        $new_user->password = "holaContra";
        $new_user->telephone = "966354870";
        $new_user->save();

        $user = Article::where('name', 'David')-> first(); // select * from articles where title = 'Test Article Insert'
        $this->assertEquals($new_user->name, $user->name);
    }

    public function testRead() {
        $user = Article::find(1); // select * from articles where id = 1
        $this->assertEquals($user->name, 'Username');
    }

    public function testUpdate(){
        $user = Article::find(1);
        $user->name = "Pepe";
        $article->save();

        $updated_user = Article::find(1);
        $this->assertEquals($updated_user->name, "Pepe");
    }

    public function testDelete(){
        $num_user = User::all()->count();
        $user = User::find(1);
        $user->delete();
        $num_user_deleted = User::all()->count();
        $this->assertTrue($num_user > $num_user_deleted);
    }
}