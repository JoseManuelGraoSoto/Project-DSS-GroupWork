<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;
use App\Models\User;
use App\Models\Article;
use App\Models\Article_user;

class Article_userTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {

        $faker = Faker::create();
        $faker->seed(1234);

        foreach (range(1, 100) as $index) {
            $article_user = Article::find($faker->numberBetween(1, 200));
            $article_user->access()->attach($faker->numberBetween(6, 150));
            $article_user->save();
        }
    }
}
