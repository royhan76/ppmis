<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'BATHSUL MASAIL',
        ]);
        DB::table('categories')->insert([
            'name' => 'BIOGRAFI',
        ]);
        DB::table('categories')->insert([
            'name' => 'EVENT',
        ]);
    }
}
