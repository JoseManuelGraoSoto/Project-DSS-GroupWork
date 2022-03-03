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
        // Llamamos a otro fichero de semillas
        $this->call(UsersTableSeeder::class );
        // Mostramos información por consola
        $this->command->info('User table seeded!');
    }   
}