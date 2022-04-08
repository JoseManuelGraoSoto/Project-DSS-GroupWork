<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ValorationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('valorations')->delete();
        // Añadimos una entrada a esta tabla
        DB::table('valorations')->insert([
            'value' => 4,
            'comment' => 'I like this papper',
            'isModerator' => true,
            'article_id' => 1,
            'user_id' => 2
        ]);

    }
}
