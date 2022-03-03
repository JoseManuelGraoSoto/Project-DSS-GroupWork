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
        $this->call( ArticlesTableSeeder::class );
        // Mostramos información por consola
        $this->command->info('Article table seeded!' );
    }   
}
