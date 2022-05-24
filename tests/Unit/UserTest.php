<?php
// php artisan migrate:refresh --seed
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase {
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreate(){
        $new_user = new User;
        $new_user->name = 'Óscar';
        $new_user->type = 'reader';
        $new_user->email = 'oscar@gmail.com';
        $new_user->password = 'holaContra';
        $new_user->telephone = '965354870';
        $new_user->save();

        $user = User::where('name', 'Óscar')-> firstOrFail(); // select * from users where name = 'Óscar'
        $this->assertEquals($new_user->name, $user->name);
    }

    public function testRead() {
        $user = User::where('email','david@gmail.com')->firstOrFail();
        $this->assertEquals($user->name,'David');
    }

    public function testUpdate(){
        $user = User::where('name','David')->firstOrFail();
        $user->type = 'author';
        $user->save();
        $updated_user = User::where('name','David')->firstOrFail();
        $this->assertEquals($updated_user->type, 'author');
    }

    public function testDelete(){
        $num_user = User::all()->count();
        $user = User::where('name','Oscar')->firstOrFail();
        $user->delete();
        $num_user_deleted = User::all()->count();
        $this->assertTrue($num_user > $num_user_deleted);
    }
}
/* 
        $new_user->name = 'Username';
        $new_user->type = 'Lector';
        $new_user->email = 'name@domain.com ';
        $new_user->password = 'strongpassword';
        $new_user->telephone = '966999999';
        */