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
            'name' => '1 Aly',
            'number'=> 1
        ]);

        DB::table('grades')->insert([
            'id' => 2,
            'name' => '2 Aly',
            'number'=> 2
        ]);
    }
}
