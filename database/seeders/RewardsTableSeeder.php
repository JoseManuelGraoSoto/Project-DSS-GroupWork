<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RewardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('rewards')->delete();
        // Añadimos una entrada a esta tabla
        DB::table('rewards')->insert([
            'points' => 4,
            'month' => 5,
            'isModerator' => true,
        ]);
    }
}
