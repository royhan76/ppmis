<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contacts')->insert([
            'name' => 'facebook',
            'url' => 'facebook.com',
            'label' => 'Facebook',
        ]);
        DB::table('contacts')->insert([
            'name' => 'twitter',
            'url' => 'twitter.com',
            'label' => 'Twitter',
        ]);
        DB::table('contacts')->insert([
            'name' => 'youtube',
            'url' => 'youtube.com',
            'label' => 'Youtube',
        ]);
        DB::table('contacts')->insert([
            'name' => 'instagram',
            'url' => 'instagram.com',
            'label' => 'Instagram',
        ]);
        DB::table('contacts')->insert([
            'name' => 'phone',
            'url' => 'phone.com',
            'label' => '085624436317',
        ]);
    }
}
