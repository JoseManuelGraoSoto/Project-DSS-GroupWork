<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;
use App\Models\Transaction;
use App\Models\User;


class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transactions = Transaction::all();
        $faker = Faker::create();
        $faker->seed(1234);

        foreach ($transactions as $transaction) {
            $transaction->delete();
        }

        foreach (range(1, 350) as $index) {
            $new_transaction = new Transaction;
            $new_transaction->user()->associate($faker->numberBetween(1, 700));

            if ($new_transaction->user->type === 'author' || $new_transaction->user->type === 'moderator') {
                $new_transaction->price = $faker->randomElement([29.99, 74.99, 199.99]);
            } else {
                $new_transaction->price = $faker->randomElement([9.99, 24.99, 99.99]);
            }
            switch ($new_transaction->price) {
                case 29.99:
                case 9.99:
                    $new_transaction->concept = '1 month subscription';
                    break;
                case 74.99:
                case 24.99:
                    $new_transaction->concept = '3 months subscription';
                    break;
                case 199.99:
                case 99.99:
                    $new_transaction->concept = '1 year subscription';
                    break;
            }
            $new_transaction->created_at = $faker->dateTimeBetween($startDate = '-4 years', $endDate = 'now', $timezone = 'Europe/Madrid');
            $new_transaction->save();
        }
    }
}
