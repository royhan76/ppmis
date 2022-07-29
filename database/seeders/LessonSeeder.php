<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lessons')->insert([
            'id' => 1,
            'name' => 'Fiqih',
            'grade_id' => 8,
            'year' => 2022,
        ]);
        DB::table('lessons')->insert([
            'id' => 2,
            'name' => 'Tasawuf',
            'grade_id' => 8,
            'year' => 2022,
        ]);
        DB::table('lessons')->insert([
            'id' => 3,
            'name' => 'Balaghoh',
            'grade_id' => 8,
            'year' => 2022,
        ]);
    }
}
