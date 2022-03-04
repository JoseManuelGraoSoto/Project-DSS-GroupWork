<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class Article_userTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('article_user')->delete();
        DB::table('article_user')->insert([
            'article_id' => 1,
            'user_id' => 2
        ]);
    }
}
