<?php

namespace Database\Seeders;

use App\Models\Slideshow;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ContactSeeder;
use Database\Seeders\ProfileSeeder;
use Database\Seeders\SlideshowSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ArticleSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            ContactSeeder::class,
            ProfileSeeder::class,
            SlideshowSeeder::class,
            CategorySeeder::class,
            ArticleSeeder::class
        ]);
    }
}
