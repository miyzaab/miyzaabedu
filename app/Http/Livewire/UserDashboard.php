<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProgress;
use App\Models\Quiz;
use App\Models\Audio;
use App\Models\Video;
use App\Models\Article;

class UserDashboard extends Component
{
    public $stats;
    public $recent_activities;
    public $quiz_results;
    public $global_score;

    public function mount()
    {
        $user = Auth::user();

        // Calculate Stats
        $this->stats = [
            'audio_completed' => UserProgress::where('user_id', $user->id)->where('content_type', Audio::class)->where('status', 'completed')->count(),
            'video_completed' => UserProgress::where('user_id', $user->id)->where('content_type', Video::class)->where('status', 'completed')->count(),
            'article_read' => UserProgress::where('user_id', $user->id)->where('content_type', Article::class)->where('status', 'read')->count(), // assuming 'read' status
            'quizzes_taken' => UserProgress::where('user_id', $user->id)->where('content_type', Quiz::class)->count(),
        ];

        // Quiz Results (Grade Center)
        $this->quiz_results = UserProgress::where('user_id', $user->id)
            ->where('content_type', Quiz::class)
            ->orderBy('updated_at', 'desc')
            ->get()
            ->map(function ($progress) {
                // Manually load content if morph map not set or simple lookup
                $quiz = Quiz::find($progress->content_id);
                return [
                    'quiz_title' => $quiz ? $quiz->title : 'Unknown Quiz',
                    'score' => $progress->score,
                    'status' => $progress->score >= ($quiz->passing_score ?? 75) ? 'Lulus' : 'Belum Lulus',
                    'date' => $progress->updated_at->format('d M Y'),
                ];
            });

        // Global Score Chart Data
        $categoryScores = UserProgress::where('user_id', $user->id)
            ->where('content_type', Quiz::class)
            ->get()
            ->groupBy(function ($item) {
                $quiz = Quiz::find($item->content_id);
                return $quiz && $quiz->category ? $quiz->category->name : 'General';
            })
            ->map(function ($items) {
                return $items->avg('score');
            });

        $this->global_score = [
            'categories' => $categoryScores->isEmpty() ? ['Umum'] : $categoryScores->keys()->toArray(),
            'scores' => $categoryScores->isEmpty() ? [0] : $categoryScores->values()->toArray(),
        ];
    }

    public function render()
    {
        return view('livewire.user-dashboard');
    }
}
