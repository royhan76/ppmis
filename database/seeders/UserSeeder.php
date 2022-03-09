<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin PPMIS',
            'username' => 'admin.ppmis',
            'role' => 'ADMIN',
            'password' => Hash::make('itppmis'),
        ]);
        DB::table('users')->insert([
            'name' => 'Mabrur',
            'username' => 'mabrur.satori',
            'role' => 'USER',
            'password' => Hash::make('mabrursatori'),
        ]);
        DB::table('users')->insert([
            'name' => 'Roichani',
            'username' => 'roichani',
            'role' => 'USER',
            'password' => Hash::make('roichani'),
        ]);
    }
}
