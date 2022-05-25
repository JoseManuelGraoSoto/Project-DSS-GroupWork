<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
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
        for($i = 0; $i <= $lista.count(); $i++) {
            $new_category = new Category;
            $new_category->category = $lista[$i];
            $name = $faker->bankAccountNumber;
            $new_category->save();
        }
    }
}