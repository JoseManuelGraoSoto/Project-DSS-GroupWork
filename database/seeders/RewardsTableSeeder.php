<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DateTime;
use App\Models\Reward;

class RewardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { //
        $reward = Reward::all();
        $faker = Faker::create();
        $faker->seed(1234);

        foreach ($reward as $reward) {
            $reward->delete();
        }

        foreach (range(1, 500) as $index) {
            $new_reward = new Reward;
            $new_reward->points = $faker->numberBetween(50, 500);
            $new_reward->month = $faker->dateTimeBetween($startDate = '-4 years', $endDate = 'now', $timezone = null);
            $new_reward->isModerator = $faker->boolean;
            $new_reward->user()->associate($faker->numberBetween(501, 700));
            $new_reward->save();
        }
    }
}
