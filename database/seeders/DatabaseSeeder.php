<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ContactSeeder;
use Database\Seeders\ProfileSeeder;
use Database\Seeders\SlideshowSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ArticleSeeder;
use Database\Seeders\DormitorySeeder;
use Database\Seeders\RoomSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\SeasonSeeder;
use Database\Seeders\GradeSeeder;
use Database\Seeders\BillSeeder;
use Database\Seeders\StudentSeeder;
use Database\Seeders\StudentBillSeeder;
use Database\Seeders\FoulSeeder;

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
             ArticleSeeder::class,
             DormitorySeeder::class,
             RoomSeeder::class,
             RoleSeeder::class,
             SeasonSeeder::class,
             BillSeeder::class,
             GradeSeeder::class,
             StudentSeeder::class,
            StudentBillSeeder::class,
            FoulSeeder::class
        ]);
    }
}
