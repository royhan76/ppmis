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
            'id' => 1,
            'name' => 'Admin PPMIS',
            'username' => 'admin.ppmis',
            'role' => 'ADMIN',
            'email' => 'ppmis@gmail.com',
            'number' => '123457',
            'password' => Hash::make('itppmis'),
            'image' => 'admin.png'
        ]);
        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Mabrur',
            'username' => 'mabrur.satori',
            'role' => 'USER',
            'email' => 'mabrur@gmail.com',
            'number' => '123457',
            'password' => Hash::make('mabrursatori'),
            'image' => 'mabrur.jpg'
        ]);
        DB::table('users')->insert([
            'id' => 3,
            'name' => 'Roichani',
            'username' => 'roichani',
            'role' => 'USER',
            'email' => 'roikhani@gmail.com',
            'number' => '123457',
            'password' => Hash::make('roichani'),
            'image' => 'roikani.jpg'
        ]);
    }
}
