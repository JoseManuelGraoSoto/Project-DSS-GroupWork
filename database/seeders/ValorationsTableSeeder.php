<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ValorationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('valorations')->delete();
        // Añadimos una entrada a esta tabla
        DB::table('valorations')->insert([
            'value' => 4,
            'comment' => 'I like this papper',
            'isModerator' => true,
        ]);

    }
}
