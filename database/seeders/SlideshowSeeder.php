<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SlideshowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('slideshows')->insert([
            'image' => Str::random(100),
            'order' => 1
        ]);
        DB::table('slideshows')->insert([
            'image' => Str::random(100),
            'order' => 2
        ]);
        DB::table('slideshows')->insert([
            'image' => Str::random(100),
            'order' => 3
        ]);
    }
}
