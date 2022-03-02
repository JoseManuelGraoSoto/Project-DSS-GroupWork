<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Articles')->delete();
        DB::table('Articles')->insert([
            'title' => 'A little Title',
            'category' => 'Technology',
            'valoration' => 3.5,
            'content' => 'This is an article about technology',
            'acepted?' => 1,
            'user_id' => 1
        ]);
    }
}
