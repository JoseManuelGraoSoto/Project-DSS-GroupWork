<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // Llamadas a ficheros de semillas
        $this->call(UsersTableSeeder::class );
        $this->call( ArticlesTableSeeder::class );
    }   
}
