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

        foreach (range(1, 350) as $index) {
            $new_valoration = new Valoration;
            $new_valoration->value = $faker->numberBetween(0, 10);
            $new_valoration->comment = '';
            $new_valoration->isModerator = $faker->boolean;
            $new_valoration->created_at = $faker->dateTimeBetween($startDate = '-4 years', $endDate = 'now', $timezone = null);
            $new_valoration->user()->associate($faker->numberBetween(1, 700));
            $new_valoration->article()->associate($faker->numberBetween(1, 300));
            $new_valoration->save();
        }

        foreach (range(351, 500) as $index) {
            $new_valoration = new Valoration;
            $new_valoration->value = $faker->numberBetween(0, 10);
            $new_valoration->comment = $faker->sentence;
            $new_valoration->isModerator = True;
            $new_valoration->created_at = $faker->dateTimeBetween($startDate = '-4 years', $endDate = 'now', $timezone = null);
            $new_valoration->user()->associate($faker->numberBetween(701, 850));
            $new_valoration->article()->associate($faker->numberBetween(1, 300));
            $new_valoration->save();
        }
    }
}
