<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('videos')->insert([
            'title' => 'Bun beats pnpm',
            'thumbnail' => '/videos/Thumbnails/Bun.png',
            'video' => '/videos/Bun.mp4',
            'user' => 'Fireship',
            'views' => '34k views - 12 days ago',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('videos')->insert([
            'title' => 'Sing - FASTER!!!',
            'thumbnail' => '/videos/Thumbnails/RamSam.png',
            'video' => '/videos/RamSam.mp4',
            'user' => 'Swann',
            'views' => '89k views - 2 months ago',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('videos')->insert([
            'title' => 'Cool training session',
            'thumbnail' => '/videos/Thumbnails/Ciri.png',
            'video' => '/videos/Ciri.mp4',
            'user' => 'Swann',
            'views' => '4k views - 6 days ago',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
