<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bills')->insert([
            'id' => 1,
            'name' => 'Daftar Ulang Santri Ndalem',
            'arrival' => 'LAMA',
            'year' => 2022,
            'nominal' => 50000,
            'role_id' => 1
        ]);
        DB::table('bills')->insert([
            'id' => 2,
            'name' => 'Daftar Ulang Santri Non-Ndalem Lama',
            'arrival' => 'LAMA',
            'year' => 2022,
            'nominal' => 50000,
            'role_id' => 2
        ]);
        DB::table('bills')->insert([
            'id' => 3,
            'name' => 'Daftar Ulang Santri Non-Ndalem Baru',
            'arrival' => 'BARU',
            'year' => 2022,
            'nominal' => 100000,
            'role_id' => 2
        ]);
    }
}
