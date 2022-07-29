<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lesson_values')->insert([
            'id' => 1,
            'lesson_id' => 1,
            'student_id' => 1,
            'year' => 2022,
            'teacher_id' => 1,
            'value' => 100,
            'grade_id' => 8
        ]);
        DB::table('lesson_values')->insert([
            'id' => 3,
            'lesson_id' => 2,
            'student_id' => 1,
            'year' => 2022,
            'teacher_id' => 1,
            'value' => 80,
            'grade_id' => 8
        ]);
        DB::table('lesson_values')->insert([
            'id' => 2,
            'lesson_id' => 3,
            'student_id' => 1,
            'year' => 2022,
            'grade_id' => 8
        ]);
    }
}
