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
        foreach (range(1, 500) as $index) {
            $new_article = new Article;
            $new_article->title = $faker->text(15);
            $new_article->category()->associate($faker->numberBetween(0, 4));
            $new_article->valoration = $faker->randomFloat(1, 0, 10);
            $new_article->content = $faker->paragraph;
            $new_article->acepted = $faker->boolean;
            if ($contador < 6) {
                $new_article->guestAccessible = 1;
                $contador++;
            } else {
                $new_article->guestAccessible = 0;
            }
            $name = $faker->bankAccountNumber;
            $new_article->pdf_path = $name . '.pdf';
            $new_article->created_at = $faker->dateTimeBetween($startDate = '-4 years', $endDate = 'now', $timezone = 'Europe/Madrid');
            $new_article->user()->associate($faker->numberBetween(501, 700));
            $new_article->save();
        }
    }
}
