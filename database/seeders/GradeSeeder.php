<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grades')->insert([
            'id' => 1,
            'name' => '3 Ibt',
            'number'=> 1
        ]);
        DB::table('grades')->insert([
            'id' => 2,
            'name' => '4 Ibt',
            'number'=> 2
        ]);

        DB::table('grades')->insert([
            'id' => 3,
            'name' => '5 Ibt',
            'number'=> 3
        ]);
        DB::table('grades')->insert([
            'id' => 4,
            'name' => '6 Ibt',
            'number'=> 4
        ]);
        DB::table('grades')->insert([
            'id' => 5,
            'name' => '1 Tsa',
            'number'=> 5
        ]);

        DB::table('grades')->insert([
            'id' => 6,
            'name' => '2 Tsa',
            'number'=> 6
        ]);
        DB::table('grades')->insert([
            'id' => 7,
            'name' => '3 Tsa',
            'number'=> 7
        ]);
        DB::table('grades')->insert([
            'id' => 8,
            'name' => '1 Aly',
            'number'=> 8
        ]);

        DB::table('grades')->insert([
            'id' => 9,
            'name' => '2 Aly',
            'number'=> 9
        ]);
        DB::table('grades')->insert([
            'id' => 10,
            'name' => '3 Aly',
            'number'=> 10
        ]);

    }
}
