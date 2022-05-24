<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;
use App\Models\Article;

class ArticlesTableSeeder extends Seeder
{

    /**
     * 
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $articles = Article::all();
        $faker = Faker::create();
        $faker->seed(1234);

        foreach ($articles as $article) {
            $article->delete();
        }

        foreach (range(1, 500) as $index) {
            $new_article = new Article;
            $new_article->title = $faker->text(15);
            $new_article->category = $faker->randomElement(['Ciencia', 'Biologia', 'Computación', 'Machine Learning']);
            $new_article->valoration = $faker->randomFloat(1, 0, 10);
            $new_article->content = $faker->paragraph;
            $new_article->acepted = $faker->boolean;
            $name = $faker->bankAccountNumber;
            $new_article->pdf_path = $name . '.pdf';
            $new_article->created_at = $faker->dateTimeBetween($startDate = '-4 years', $endDate = 'now', $timezone = null);
            $new_article->user()->associate($faker->numberBetween(501, 700));
            $new_article->save();
        }
    }
}