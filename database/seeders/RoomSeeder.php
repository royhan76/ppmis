<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert([
            'name' => 'A1',
            'dormitory_id'=> 1
        ]);
        DB::table('rooms')->insert([
            'name' => 'B1',
            'dormitory_id'=> 2
        ]);
        DB::table('rooms')->insert([
            'name' => 'C1',
            'dormitory_id'=> 3
        ]);
        DB::table('rooms')->insert([
            'name' => 'G1',
            'dormitory_id'=> 4
        ]);
        DB::table('rooms')->insert([
            'name' => 'H1',
            'dormitory_id'=> 5
        ]);
        DB::table('rooms')->insert([
            'name' => 'PR1',
            'dormitory_id'=> 6
        ]);
    }
}
