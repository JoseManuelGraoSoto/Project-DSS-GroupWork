<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Faker\Provider\es_ES\PhoneNumber;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    const FILE_SRC = '/public/images/';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $users = User::all();
        $faker = Faker::create('es_ES');
        $faker->seed(1235);
        foreach ($users as $user) {
            $user->delete();
        }

        $new_user = new User;
        $new_user->name = 'admin';
        $new_user->type = 'administrator';
        $new_user->email = 'admin@admin.com';
        $new_user->password = 'admin';
        $new_user->telephone = $faker->tollFreeNumber;
        $new_user->created_at = $faker->dateTimeBetween($startDate = '-4 years', $endDate = 'now', $timezone = null);
        $new_user->numberDaysSuscripted = 365;
        $new_user->imagen_path = self::FILE_SRC . 'prueba.pdf';
        $new_user->save();

        foreach (range(2, 500) as $index) {
            $new_user = new User;
            $new_user->name = $faker->firstName;
            $new_user->type = $faker->randomElement(['reader', 'author', 'moderator', 'administrator']);
            $new_user->email = $faker->unique()->freeEmail;
            $new_user->password = $faker->regexify('([A-Z]){2,3}([0-9]){2,3}([.@%]){1,2}([a-z]){3,4}');
            $new_user->telephone = $faker->tollFreeNumber;
            $new_user->created_at = $faker->dateTimeBetween($startDate = '-4 years', $endDate = 'now', $timezone = null);
            $new_user->numberDaysSuscripted = $faker->numberBetween(0, 365);
            $name = $faker->bankAccountNumber;
            $new_user->imagen_path = self::FILE_SRC. $name . '.jpg';
            $new_user->save();
        }

        foreach (range(501, 700) as $index) {
            $new_user = new User;
            $new_user->name = $faker->firstName;
            $new_user->type = 'author';
            $new_user->email = $faker->unique()->freeEmail;
            $new_user->password = $faker->regexify('([A-Z]){2,3}([0-9]){2,3}([.@%]){1,2}([a-z]){3,4}');
            $new_user->telephone = $faker->tollFreeNumber;
            $new_user->created_at = $faker->dateTimeBetween($startDate = '-4 years', $endDate = 'now', $timezone = null);
            $new_user->numberDaysSuscripted = $faker->numberBetween(0, 365);
            $name = $faker->bankAccountNumber;
            $new_user->imagen_path = self::FILE_SRC. $name . '.jpg';
            $new_user->save();
        }

        foreach (range(701, 850) as $index) {
            $new_user = new User;
            $new_user->name = $faker->firstName;
            $new_user->type = 'moderator';
            $new_user->email = $faker->unique()->freeEmail;
            $new_user->password = $faker->regexify('([A-Z]){2,3}([0-9]){2,3}([.@%]){1,2}([a-z]){3,4}');
            $new_user->telephone = $faker->tollFreeNumber;
            $new_user->numberDaysSuscripted = $faker->numberBetween(0, 365);
            $name = $faker->bankAccountNumber;
            $new_user->imagen_path = self::FILE_SRC. $name . '.jpg';
            $new_user->created_at = $faker->dateTimeBetween($startDate = '-4 years', $endDate = 'now', $timezone = null);
            $new_user->save();
        }
    }
}