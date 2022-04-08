<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $users = User::all();
        $faker = Faker::create();
        $faker->seed(1234);

        foreach ($users as $user) {
            $user->delete();
        }
        
    	foreach (range(1,500) as $index) {
            $new_user = new User;
            $new_user->name = $faker->firstName;
            $new_user->type = $faker->randomElement(['reader', 'author', 'moderator', 'administrator']);
            $new_user->email = $faker->unique()->freeEmail;
            $new_user->password = $faker->userName;
            $new_user->telephone = $faker->e164PhoneNumber;
            $new_user->created_at = $faker->dateTimeBetween($startDate = '-4 years', $endDate = 'now', $timezone = null);
            $new_user->save();
        }
    }

}
