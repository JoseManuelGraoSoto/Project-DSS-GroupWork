<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Category;



class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorys = Category::all();
        $faker = Faker::create();
        $faker->seed(1234);

        foreach ($categorys as $category) {
            $category->delete();
        }
        $lista = ['Ciencia', 'Biologia', 'Computación', 'Machine Learning'];
        foreach ($lista as $category) {
            $new_category = new Category;
            $new_category->category = $category;
            $new_category->save();
        }
    }
}
