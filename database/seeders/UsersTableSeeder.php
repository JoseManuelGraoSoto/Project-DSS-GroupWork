<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Faker\Provider\es_ES\PhoneNumber;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DateTime;
use DateTimeZone;
use DateInterval;


class UsersTableSeeder extends Seeder
{
    const FILE_SRC = '';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
        $new_user->password = Hash::make('admin');
        $new_user->telephone = $faker->tollFreeNumber;
        $new_user->created_at = $faker->dateTimeBetween($startDate = '-4 years', $endDate = 'now', $timezone = 'Europe/Madrid');
        $new_user->numberDaysSuscripted = 365;
        $timeZone = new DateTimeZone('Europe/Madrid');
        $dateNow = new DateTime();
        $dateNow->setTimezone($timeZone);
        $dateNow->add(new DateInterval('P10Y'));
        $new_user->endSubscriptionDate = $dateNow->format('Y-m-d');

        $name = "default";
        $new_user->imagen_path = self::FILE_SRC . $name . '.png';
        $new_user->save();

        $new_user = new User;
        $new_user->name = 'reader';
        $new_user->type = 'reader';
        $new_user->email = 'reader@reader.com';
        $new_user->password = Hash::make('reader');
        $new_user->telephone = $faker->tollFreeNumber;
        $new_user->created_at = $faker->dateTimeBetween($startDate = '-4 years', $endDate = 'now', $timezone = 'Europe/Madrid');
        $new_user->numberDaysSuscripted = 365;
        $name = "default";
        $new_user->imagen_path = self::FILE_SRC . $name . '.png';
        $new_user->save();

        $new_user = new User;
        $new_user->name = 'readerExpired';
        $new_user->type = 'reader';
        $new_user->email = 'reader@reader.com';
        $new_user->password = Hash::make('reader');
        $new_user->telephone = $faker->tollFreeNumber;
        $new_user->created_at = $faker->dateTimeBetween($startDate = '-4 years', $endDate = 'now', $timezone = 'Europe/Madrid');
        $new_user->numberDaysSuscripted = 365;
        $name = "default";
        $new_user->imagen_path = self::FILE_SRC . $name . '.png';
        $new_user->save();

        $new_user = new User;
        $new_user->name = 'admin';
        $new_user->type = 'administrator';
        $new_user->email = 'admin@admin.com';
        $new_user->password = Hash::make('admin');
        $new_user->telephone = $faker->tollFreeNumber;
        $new_user->created_at = $faker->dateTimeBetween($startDate = '-4 years', $endDate = 'now', $timezone = 'Europe/Madrid');
        $new_user->numberDaysSuscripted = 365;
        $name = "default";
        $new_user->imagen_path = self::FILE_SRC . $name . '.png';
        $new_user->save();

        $new_user = new User;
        $new_user->name = 'admin';
        $new_user->type = 'administrator';
        $new_user->email = 'admin@admin.com';
        $new_user->password = Hash::make('admin');
        $new_user->telephone = $faker->tollFreeNumber;
        $new_user->created_at = $faker->dateTimeBetween($startDate = '-4 years', $endDate = 'now', $timezone = 'Europe/Madrid');
        $new_user->numberDaysSuscripted = 365;
        $name = "default";
        $new_user->imagen_path = self::FILE_SRC . $name . '.png';
        $new_user->save();

        foreach (range(2, 50) as $index) {
            $new_user = new User;
            $new_user->name = $faker->firstName;
            $new_user->type = $faker->randomElement(['reader', 'author', 'moderator', 'administrator']);
            $new_user->email = $faker->unique()->freeEmail;
            $new_user->password = Hash::make($faker->regexify('([A-Z]){2,3}([0-9]){2,3}([.@%]){1,2}([a-z]){3,4}'));
            $new_user->telephone = $faker->tollFreeNumber;
            $new_user->created_at = $faker->dateTimeBetween($startDate = '-4 years', $endDate = 'now', $timezone = 'Europe/Madrid');
            $new_user->numberDaysSuscripted = $faker->numberBetween(0, 365);
            $new_user->endSubscriptionDate =  $faker->dateTimeBetween($startDate = 'now', $endDate = '1 year', $timezone = 'Europe/Madrid');

            $name = "default";
            $new_user->imagen_path = self::FILE_SRC . $name . '.png';
            $new_user->save();
        }

        foreach (range(52, 100) as $index) {
            $new_user = new User;
            $new_user->name = $faker->firstName;
            $new_user->type = 'author';
            $new_user->email = $faker->unique()->freeEmail;
            $new_user->password = Hash::make($faker->regexify('([A-Z]){2,3}([0-9]){2,3}([.@%]){1,2}([a-z]){3,4}'));
            $new_user->telephone = $faker->tollFreeNumber;
            $new_user->created_at = $faker->dateTimeBetween($startDate = '-4 years', $endDate = 'now', $timezone = 'Europe/Madrid');
            $new_user->numberDaysSuscripted = $faker->numberBetween(0, 365);
            $new_user->endSubscriptionDate =  $faker->dateTimeBetween($startDate = 'now', $endDate = '1 year', $timezone = 'Europe/Madrid');
            $name = "default";
            $new_user->imagen_path = self::FILE_SRC . $name . '.png';
            $new_user->save();
        }

        foreach (range(701, 850) as $index) {
            $new_user = new User;
            $new_user->name = $faker->firstName;
            $new_user->type = 'moderator';
            $new_user->email = $faker->unique()->freeEmail;
            $new_user->password = Hash::make($faker->regexify('([A-Z]){2,3}([0-9]){2,3}([.@%]){1,2}([a-z]){3,4}'));
            $new_user->telephone = $faker->tollFreeNumber;
            $new_user->numberDaysSuscripted = $faker->numberBetween(0, 365);
            $new_user->endSubscriptionDate =  $faker->dateTimeBetween($startDate = 'now', $endDate = '1 year', $timezone = 'Europe/Madrid');
            $name = "default";
            $new_user->imagen_path = self::FILE_SRC . $name . '.png';
            $new_user->created_at = $faker->dateTimeBetween($startDate = '-4 years', $endDate = 'now', $timezone = 'Europe/Madrid');
            $new_user->save();
        }
    }
}
