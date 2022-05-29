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

        $contador = 0;
        foreach (range(1, 200) as $index) {
            $new_article = new Article;
            $new_article->title = $faker->text(15);
            $new_article->category()->associate($faker->numberBetween(1, 4));
            $new_article->content = $faker->paragraph;
            if ($contador < 5) {
                $new_article->guestAccessible = 1;
                $new_article->acepted = 1;
                $contador++;
            } else {
                $new_article->guestAccessible = 0;
                $new_article->acepted = $faker->boolean;
            }
            $new_article->pdf_path = 'prueba.pdf';
            $new_article->created_at = $faker->dateTimeBetween($startDate = '-4 years', $endDate = 'now', $timezone = 'Europe/Madrid');
            $new_article->user()->associate($faker->numberBetween(51, 100));
            $new_article->save();
        }
    }
}
