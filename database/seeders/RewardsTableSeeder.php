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

        foreach (range(51, 100) as $index) {
            $new_reward = new Reward;
            $new_reward->points = $faker->numberBetween(0, 100);
            $new_reward->isModerator = 0;
            $new_reward->user()->associate($faker->numberBetween(51, 100));
            $new_reward->save();
        }

        foreach (range(101, 150) as $index) {
            $new_reward = new Reward;
            $new_reward->points = $faker->numberBetween(0, 100);
            $new_reward->isModerator = 1;
            $new_reward->user()->associate($faker->numberBetween(101, 150));
            $new_reward->save();
        }
    }
}
