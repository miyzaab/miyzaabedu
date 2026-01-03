<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
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
        // Ensure we have an admin or user to be the author
        $author = User::first() ?? User::factory()->create();

        $categories = [
            ['name' => 'Aqidah', 'description' => 'Artikel seputar keimanan.'],
            ['name' => 'Sirah', 'description' => 'Kisah perjalanan Nabi dan Sahabat.'],
            ['name' => 'Fiqih', 'description' => 'Hukum islam sehari-hari.'],
        ];

        foreach ($categories as $catData) {
            // Create or find category specifically for articles
            $category = Category::firstOrCreate(
                ['slug' => Str::slug($catData['name']) . '-artikel'], // Suffix to distinguish if needed, or share slug if single table
                [
                    'name' => $catData['name'],
                    'type' => 'article',
                ]
            );

            // Create 2 dummy articles per category
            for ($i = 1; $i <= 2; $i++) {
                $title = "Mengenal " . $catData['name'] . " Bagian " . $i;
                Article::firstOrCreate(
                    ['slug' => Str::slug($title)],
                    [
                        'title' => $title,
                        'content' => $this->generateDummyContent($catData['name']),
                        'author_id' => $author->id,
                        'category_id' => $category->id,
                        'published_at' => now(),
                    ]
                );
            }
        }
    }

    private function generateDummyContent($topic)
    {
        return "
            <p class='mb-4'>Ini adalah paragraf pembuka untuk artikel tentang {$topic}. Islam mengajarkan kita untuk senantiasa menuntut ilmu dari buaian hingga liang lahat. Semoga artikel ini memberikan manfaat bagi pembaca sekalian.</p>

            <h3 class='text-xl font-bold mb-2'>Pentingnya Mempelajari {$topic}</h3>
            <p class='mb-4'>{$topic} merupakan salah satu aspek vital dalam agama Islam. Dengan memahaminya, kita dapat menjalankan kehidupan sehari-hari sesuai dengan tuntunan syariat. Rasulullah SAW bersabda mengenai keutamaan ilmu dalam berbagai haditsnya.</p>
            
            <p class='mb-4'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

            <h3 class='text-xl font-bold mb-2'>Kesimpulan</h3>
            <p>Marilah kita terus meningkatkan kualitas diri dengan belajar. Barakallahu fiikum.</p>
        ";
    }
}
