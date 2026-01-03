<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProgress;
use App\Models\Quiz;
use Illuminate\Http\Request;

class UserProgressController extends Controller
{
    /**
     * Display a listing of all users with their quiz statistics.
     */
    public function index()
    {
        $users = User::where('role', '!=', 'admin')
            ->where('role', '!=', 'super_admin')
            ->withCount([
                'progress as quizzes_taken' => function ($query) {
                    $query->where('content_type', 'App\\Models\\Quiz');
                }
            ])
            ->withAvg([
                'progress as avg_score' => function ($query) {
                    $query->where('content_type', 'App\\Models\\Quiz')
                        ->whereNotNull('score');
                }
            ], 'score')
            ->withCount([
                'progress as quizzes_passed' => function ($query) {
                    $query->where('content_type', 'App\\Models\\Quiz')
                        ->where('status', 'completed');
                }
            ])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.progress.index', compact('users'));
    }

    /**
     * Display detailed progress for a specific user.
     */
    public function show(User $user)
    {
        // Get all quiz progress for this user
        $quizProgress = UserProgress::where('user_id', $user->id)
            ->where('content_type', 'App\\Models\\Quiz')
            ->orderBy('updated_at', 'desc')
            ->get()
            ->map(function ($progress) {
                $quiz = Quiz::find($progress->content_id);
                return [
                    'quiz' => $quiz,
                    'score' => $progress->score,
                    'status' => $progress->status,
                    'completed_at' => $progress->updated_at,
                    'passing_score' => $quiz ? $quiz->passing_score : 70,
                    'passed' => $progress->score >= ($quiz ? $quiz->passing_score : 70),
                ];
            });

        // Count progress by content type
        $audioCount = UserProgress::where('user_id', $user->id)
            ->where('content_type', 'App\\Models\\Audio')
            ->where('status', 'completed')
            ->count();

        $videoCount = UserProgress::where('user_id', $user->id)
            ->where('content_type', 'App\\Models\\Video')
            ->where('status', 'completed')
            ->count();

        $articleCount = UserProgress::where('user_id', $user->id)
            ->where('content_type', 'App\\Models\\Article')
            ->where('status', 'completed')
            ->count();

        $quizStats = [
            'total' => $quizProgress->count(),
            'passed' => $quizProgress->where('passed', true)->count(),
            'failed' => $quizProgress->where('passed', false)->count(),
            'avg_score' => $quizProgress->avg('score') ?? 0,
        ];

        return view('admin.progress.show', compact(
            'user',
            'quizProgress',
            'audioCount',
            'videoCount',
            'articleCount',
            'quizStats'
        ));
    }
}
