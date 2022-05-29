<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;
use App\Models\Valoration;

class ValorationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $valoration = Valoration::all();
        $faker = Faker::create();
        $faker->seed(1234);

        foreach ($valoration as $valoration) {
            $valoration->delete();
        }

        foreach (range(6, 50) as $index) {
            $new_valoration = new Valoration;
            $new_valoration->value = $faker->numberBetween(0, 5);
            $new_valoration->created_at = $faker->dateTimeBetween($startDate = '-4 years', $endDate = 'now', $timezone = 'Europe/Madrid');
            $new_valoration->user()->associate($faker->numberBetween(5, 50));
            $new_valoration->article()->associate($faker->numberBetween(1, 200));
            $new_valoration->save();
        }

        foreach (range(51, 100) as $index) {
            $new_valoration = new Valoration;
            $new_valoration->value = $faker->numberBetween(0, 5);
            $new_valoration->created_at = $faker->dateTimeBetween($startDate = '-4 years', $endDate = 'now', $timezone = 'Europe/Madrid');
            $new_valoration->user()->associate($faker->numberBetween(51, 100));
            $new_valoration->article()->associate($faker->numberBetween(1, 200));
            $new_valoration->save();
        }

        foreach (range(101, 150) as $index) {
            $new_valoration = new Valoration;
            $new_valoration->value = $faker->numberBetween(0, 5);
            $new_valoration->created_at = $faker->dateTimeBetween($startDate = '-4 years', $endDate = 'now', $timezone = 'Europe/Madrid');
            $new_valoration->user()->associate($faker->numberBetween(101, 150));
            $new_valoration->article()->associate($faker->numberBetween(1, 200));
            $new_valoration->save();
        }
    }
}
