<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->delete();
        // Añadimos una entrada a esta tabla
        DB::table('users')->insert([
            'name' => 'David',
            'type' => 'reader',
            'email' => 'david@gmail.com',
            'password' => 'holaContra',
            'telephone' => '966354870'
        ]);

        DB::table('users')->insert([
            'name' => 'Juan',
            'type' => 'author',
            'email' => 'juan@gmail.com',
            'password' => 'autor123',
            'telephone' => '966323370'
        ]);
    }

}
