<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class FoulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fouls')->insert([
            'student_id' => 2,
            'name' => 'Mblorot Jam Ke-2',
            'date' => Carbon::now()
        ]);
    }
}
