<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use DateTime;

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
            'month' => new DateTime('2022-03-28'),
            'isModerator' => true,
            'article_id' => 1
        ]);
    }
}
