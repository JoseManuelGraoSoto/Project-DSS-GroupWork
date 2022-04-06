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

        DB::table('users')->insert([
            'name' => 'Pedro',
            'type' => 'reader',
            'email' => 'pedro@gmail.com',
            'password' => 'pedroTusabe',
            'telephone' => '966428156'
        ]);

        DB::table('users')->insert([
            'name' => 'Ivan',
            'type' => 'reader',
            'email' => 'ivan777@gmail.com',
            'password' => 'ivanElCRack',
            'telephone' => '988251346'
        ]);

        DB::table('users')->insert([
            'name' => 'Jose',
            'type' => 'administrator',
            'email' => 'jose19@gmail.com',
            'password' => 'jose1999',
            'telephone' => '966543769'
        ]);

        DB::table('users')->insert([
            'name' => 'Arturo',
            'type' => 'moderator',
            'email' => 'arturito12@gmail.com',
            'password' => 'arturo41',
            'telephone' => '987654321'
        ]);

        DB::table('users')->insert([
            'name' => 'Carlos',
            'type' => 'author',
            'email' => 'carlosBaute@gmail.com',
            'password' => 'carlosBct',
            'telephone' => '977444651'
        ]);

        DB::table('users')->insert([
            'name' => 'Abel',
            'type' => 'reader',
            'email' => 'abel98@gmail.com',
            'password' => 'abelYnobel',
            'telephone' => '966123773'
        ]);

        DB::table('users')->insert([
            'name' => 'Marco',
            'type' => 'author',
            'email' => 'marco-44@gmail.com',
            'password' => 'marcoDeLaPuerta',
            'telephone' => '985333264'
        ]);

        DB::table('users')->insert([
            'name' => 'Pepe',
            'type' => 'reader',
            'email' => 'pepeMadrid@gmail.com',
            'password' => 'madridistaHastaLaMuerte',
            'telephone' => '955812346'
        ]);
    }

}
