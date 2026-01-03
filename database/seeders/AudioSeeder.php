<?php

namespace Database\Seeders;

use App\Models\Audio;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Create Categories
        $categories = [
            ['name' => 'Aqidah', 'description' => 'Memahami pondasi keimanan Islam.', 'icon' => 'book', 'color' => 'emerald'],
            ['name' => 'Sirah', 'description' => 'Sejarah perjalanan hidup Nabi Muhammad SAW.', 'icon' => 'globe', 'color' => 'teal'],
            ['name' => 'Fiqih', 'description' => 'Panduan ibadah dan hukum sehari-hari.', 'icon' => 'scale', 'color' => 'cyan'],
        ];

        foreach ($categories as $cat) {
            $category = Category::firstOrCreate(
                ['slug' => Str::slug($cat['name'])],
                [
                    'name' => $cat['name'],
                    'type' => 'audio', // Ensure we distinguish from article categories if needed
                    'description' => $cat['description'],
                    'color' => $cat['color'] ?? 'emerald' // Default fallback
                ]
            );

            // 2. Create Dummy Audios for each Category
            // We'll create 3 sessions per category
            for ($i = 1; $i <= 3; $i++) {
                Audio::firstOrCreate(
                    ['slug' => Str::slug($cat['name'] . ' Sesi ' . $i)],
                    [
                        'title' => $cat['name'] . ' - Sesi ' . $i,
                        'category_id' => $category->id,
                        'file_path' => 'audios/sample.mp3', // Placeholder, ensure this file exists or is handled
                        'duration' => 300, // 5 minutes dummy duration
                        'sequence_order' => $i,
                    ]
                );
            }
        }
    }
}
