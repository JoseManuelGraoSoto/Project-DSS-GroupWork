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
        $new_user->name = 'David';
        $new_user->type = 'Lector';
        $new_user->email = 'david@gmail.com';
        $new_user->password = 'holaContra';
        $new_user->telephone = '966354870';
        $new_user->save();

        $user = User::where('name', 'David')-> first(); // select * from users where name = 'David'
        $this->assertEquals($new_user->name, $user->name);
    }

    public function testRead() {
        $users = User::all();
        foreach($users as $user) {
            $this->assertEquals($user->name,'David');
        }
    }

    public function testUpdate(){
        $users = User::all();
        foreach($users as $user) {
            if ($user->name == 'David') {
                $user->type = 'Autor';
            }
        }
        $user->save();

        $updated_user = User::first();
        $this->assertEquals($updated_user->type, 'Autor');
    }

    public function testDelete(){
        $num_user = User::all()->count();
        $user = User::first();
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