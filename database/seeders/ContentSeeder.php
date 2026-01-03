<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Article;
use App\Models\Video;
use App\Models\User;
use Illuminate\Support\Str;

class ContentSeeder extends Seeder
{
    public function run()
    {
        $admin = User::first();

        // Articles Category
        $fiqih = Category::firstOrCreate(
            ['slug' => 'fiqih-shalat'],
            [
                'name' => 'Fiqih Shalat',
                'type' => 'article'
            ]
        );

        Article::firstOrCreate(
            ['slug' => 'panduan-shalat-khusyu'],
            [
                'title' => 'Panduan Shalat Khusyu',
                'content' => "Shalat khusyu adalah inti dari ibadah kita.\n\nBerikut adalah beberapa tips untuk mencapainya:\n1. Pahami makna bacaan.\n2. Tuma'ninah dalam setiap gerakan.\n3. Fokuskan pandangan ke tempat sujud.",
                'category_id' => $fiqih->id,
                'author_id' => $admin->id ?? 1,
                'published_at' => now(),
            ]
        );

        Article::firstOrCreate(
            ['slug' => 'keutamaan-shalat-berjamaah'],
            [
                'title' => 'Keutamaan Shalat Berjamaah',
                'content' => "Shalat berjamaah memiliki keutamaan 27 derajat dibanding shalat sendirian.\n\nRasulullah SAW sangat menganjurkan umatnya untuk memakmurkan masjid.",
                'category_id' => $fiqih->id,
                'author_id' => $admin->id ?? 1,
                'published_at' => now(),
            ]
        );


        // Videos Category
        $kajian = Category::firstOrCreate(
            ['slug' => 'kajian-tematik'],
            [
                'name' => 'Kajian Tematik',
                'type' => 'video'
            ]
        );

        Video::firstOrCreate(
            ['slug' => 'tafsir-surat-al-fatihah'],
            [
                'title' => 'Tafsir Surat Al-Fatihah',
                'youtube_id' => 'tgbNymZ7vqY', // Example ID
                'category_id' => $kajian->id,
                'duration' => '15:30',
            ]
        );

        Video::firstOrCreate(
            ['slug' => 'kisah-nabi-ibrahim'],
            [
                'title' => 'Kisah Nabi Ibrahim',
                'youtube_id' => 'ExampleID2',
                'category_id' => $kajian->id,
                'duration' => '20:00',
            ]
        );
    }
}
