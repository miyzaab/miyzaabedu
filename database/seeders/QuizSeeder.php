<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Audio;
use App\Models\Quiz;
use App\Models\Question;

class QuizSeeder extends Seeder
{
    public function run()
    {
        // Get all audios and create a quiz for each
        $audios = Audio::all();

        foreach ($audios as $audio) {
            $quiz = Quiz::firstOrCreate(
                ['audio_id' => $audio->id],
                [
                    'title' => 'Kuis: ' . $audio->title,
                    'category_id' => $audio->category_id,
                    'passing_score' => 75,
                ]
            );

            // Create questions based on audio title
            $this->createQuestionsForQuiz($quiz, $audio);
        }
    }

    private function createQuestionsForQuiz(Quiz $quiz, Audio $audio)
    {
        // Sample questions - in real app these would be specific to each audio content
        $questionSets = [
            'Mengenal Allah' => [
                ['text' => 'Siapakah Pencipta alam semesta ini?', 'options' => ['A' => 'Malaikat', 'B' => 'Allah', 'C' => 'Manusia', 'D' => 'Jin'], 'answer' => 'B'],
                ['text' => 'Berapa jumlah Asmaul Husna?', 'options' => ['A' => '50', 'B' => '77', 'C' => '99', 'D' => '100'], 'answer' => 'C'],
            ],
            'Mengenal Rasulullah' => [
                ['text' => 'Siapa nama Nabi terakhir?', 'options' => ['A' => 'Nabi Isa', 'B' => 'Nabi Musa', 'C' => 'Nabi Muhammad', 'D' => 'Nabi Ibrahim'], 'answer' => 'C'],
                ['text' => 'Di kota mana Rasulullah SAW lahir?', 'options' => ['A' => 'Madinah', 'B' => 'Makkah', 'C' => 'Thaif', 'D' => 'Yaman'], 'answer' => 'B'],
            ],
            'Mengenal Agama Islam' => [
                ['text' => 'Apa rukun iman yang pertama?', 'options' => ['A' => 'Iman kepada Kitab', 'B' => 'Iman kepada Rasul', 'C' => 'Iman kepada Allah', 'D' => 'Iman kepada Hari Akhir'], 'answer' => 'C'],
                ['text' => 'Berapa jumlah rukun Islam?', 'options' => ['A' => '4', 'B' => '5', 'C' => '6', 'D' => '7'], 'answer' => 'B'],
            ],
        ];

        // Get questions for this audio, or use default
        $questions = $questionSets[$audio->title] ?? [
            ['text' => 'Apa yang Anda pelajari dari materi ' . $audio->title . '?', 'options' => ['A' => 'Tidak ada', 'B' => 'Sedikit', 'C' => 'Banyak', 'D' => 'Sangat banyak'], 'answer' => 'D'],
        ];

        foreach ($questions as $q) {
            Question::firstOrCreate(
                ['quiz_id' => $quiz->id, 'text' => $q['text']],
                [
                    'options' => $q['options'],
                    'correct_answer' => $q['answer'],
                ]
            );
        }
    }
}
