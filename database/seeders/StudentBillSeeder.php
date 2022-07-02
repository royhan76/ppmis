<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentBillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('student_bills')->insert([
            'student_id' => 1,
            'bill_id' => 2,
            'year' => 2022,
            'status' => 0
        ]);
    }
}
