<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->insert([
            'logo' => Str::random(100),
            'registration' => Str::random(10),
            'title' => "Biografi PP. MIS",
            'image' => Str::random(10),
            'content' => Str::random(1000)
        ]);
    }
}
