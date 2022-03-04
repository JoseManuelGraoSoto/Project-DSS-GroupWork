<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class Access_to_articlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('access_to_articles')->delete();
        DB::table('access_to_articles')->insert([
            'article_id' => 1,
            'user_id' => 2
        ]);
    }
}
