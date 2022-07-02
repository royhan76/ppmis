<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class SeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seasons')->insert([
            'year' => 2022
        ]);
        DB::table('seasons')->insert([
            'year' => 2023
        ]);
    }
}
