<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            'id' => 1,
            'name' => 'Mabrur',
            'nomor_induk_santri' => '1234567',
            'date_birth' => Carbon::now(),
            'photo' => Str::random(100),
            'arrival' => 'LAMA',
            'address' => 'Perbutulan Sumber Cirebon',
            'room_id' => 1,
            'role_id' => 2,
            'year' => 2022,
            'user_id' => 2,
            'grade_id' => 1

        ]);
    }
}
