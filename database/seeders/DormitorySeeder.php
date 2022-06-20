<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DormitorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dormitories')->insert([
            'id' => 1,
            'name' => 'Komplek A',
        ]);
        DB::table('dormitories')->insert([
            'id' => 2,
            'name' => 'Komplek B',
        ]);
        DB::table('dormitories')->insert([
            'id' => 3,
            'name' => 'Komplek C',
        ]);
        DB::table('dormitories')->insert([
            'id' => 4,
            'name' => 'Komplek G',
        ]);
        DB::table('dormitories')->insert([
            'id' => 5,
            'name' => 'Komplek H',
        ]);
        DB::table('dormitories')->insert([
            'id' => 6,
            'name' => 'Komplek PR',
        ]);
    }
}
