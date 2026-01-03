<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Audio;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // Admin User
        \App\Models\User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Muslim Learner',
                'password' => bcrypt('password'),
                'is_admin' => true,
            ]
        );

        $this->call([
            QuizSeeder::class,
            ContentSeeder::class,
            ArticleSeeder::class,
        ]);

        // Categories
        $categories = [
            ['name' => 'Aqidah', 'type' => 'audio'],
            ['name' => 'Sirah Nabawiyah', 'type' => 'audio'],
            ['name' => 'Fiqih Ibadah', 'type' => 'audio'],
        ];

        foreach ($categories as $cat) {
            $category = Category::firstOrCreate(
                ['slug' => Str::slug($cat['name'])],
                [
                    'name' => $cat['name'],
                    'type' => $cat['type'],
                ]
            );

            // Dummy Audio Content
            if ($cat['name'] === 'Aqidah') {
                $titles = ['Mengenal Allah', 'Mengenal Rasulullah', 'Mengenal Agama Islam'];
                foreach ($titles as $index => $title) {
                    Audio::firstOrCreate(
                        ['slug' => Str::slug($title)],
                        [
                            'title' => $title,
                            // Using a real external MP3 for demo purposes (Al-Fatihah as placeholder)
                            'file_path' => 'https://server8.mp3quran.net/afs/001.mp3',
                            'category_id' => $category->id,
                            'duration' => 60, // 1 min approximate
                            'sequence_order' => $index + 1,
                        ]
                    );
                }
            }
        }

        // Run quiz seeder after audio is created
        $this->call(QuizSeeder::class);
    }
}
