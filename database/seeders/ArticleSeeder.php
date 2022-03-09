<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->insert([
            'title' => Str::random(50),
            'image' => Str::random(100),
            'caption' => Str::random(100),
            'content' => Str::random(100),
            'user_id' => random_int(2, 3),
            'category_id' => random_int(1, 3)
        ]);
        DB::table('articles')->insert([
            'title' => Str::random(50),
            'image' => Str::random(100),
            'caption' => Str::random(100),
            'content' => Str::random(100),
            'user_id' => random_int(2, 3),
            'category_id' => random_int(1, 3)
        ]);
        DB::table('articles')->insert([
            'title' => Str::random(50),
            'image' => Str::random(100),
            'caption' => Str::random(100),
            'content' => Str::random(100),
            'user_id' => random_int(2, 3),
            'category_id' => random_int(1, 3)
        ]);
    }
}
