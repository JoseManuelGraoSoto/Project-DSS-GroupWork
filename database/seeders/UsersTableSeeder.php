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
        'name' => 'Username',
        'type' => 'Lector',
        'email' => 'name@domain.com ',
        'password' => 'strongpassword',
        'telephone' => '966999999'
    ]);
    }
}
