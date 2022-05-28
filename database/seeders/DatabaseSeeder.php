<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Llamadas a ficheros de semillas
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        $this->call(Article_userTableSeeder::class);
        $this->call(RewardsTableSeeder::class);
        $this->call(ValorationsTableSeeder::class);
        $this->call(TransactionsTableSeeder::class);
    }
}
