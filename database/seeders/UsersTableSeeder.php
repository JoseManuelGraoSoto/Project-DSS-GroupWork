<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            $user->delete();
        }

        $new_user = new User;
        $new_user->name = 'David';
        $new_user->type = 'reader';
        $new_user->email = 'david@gmail.com';
        $new_user->password = 'holaContra';
        $new_user->telephone = '966354870';
        $new_user->save();

        $new_user = new User;
        $new_user->name = 'Juan';
        $new_user->type = 'author';
        $new_user->email = 'juan@gmail.com';
        $new_user->password = 'autor123';
        $new_user->telephone = '966323370';
        $new_user->save();
    }
}
