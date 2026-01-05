<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Audio;
use App\Models\UserProgress;
use Illuminate\Http\Request;

class AudioLearningController extends Controller
{
    // Level 1: Show list of Marhalah
    public function index()
    {
        // Group categories by marhalah
        $categories = Category::where('type', 'audio')
            ->withCount('audios')
            ->orderBy('marhalah')
            ->orderBy('name')
            ->get();

        // Group by marhalah level
        $marhalahGroups = $categories->groupBy('marhalah');

        return view('audio.index', compact('marhalahGroups'));
    }

    // Level 2: Show list of Pelajaran (categories) in a Marhalah
    public function marhalah($level)
    {
        $categories = Category::where('type', 'audio')
            ->where('marhalah', $level)
            ->withCount('audios')
            ->with('audios')
            ->orderBy('name')
            ->get();

        return view('audio.marhalah', compact('categories', 'level'));
    }

    // Level 3: Show list of Audio in a Category/Pelajaran
    public function show($slug)
    {
        $category = Category::where('slug', $slug)
            ->with([
                'audios' => function ($query) {
                    $query->orderBy('sequence_order', 'asc');
                },
                'audios.quiz'
            ])
            ->firstOrFail();

        $audioIds = $category->audios->pluck('id');
        $userProgress = UserProgress::where('user_id', auth()->id())
            ->where('content_type', Audio::class)
            ->whereIn('content_id', $audioIds)
            ->get()
            ->keyBy('content_id');

        // Get completed quiz IDs for this user
        $quizIds = $category->audios->pluck('quiz.id')->filter();
        $completedQuizzes = UserProgress::where('user_id', auth()->id())
            ->where('content_type', \App\Models\Quiz::class)
            ->whereIn('content_id', $quizIds)
            ->where('status', 'completed')
            ->pluck('content_id')
            ->toArray();

        return view('audio.show', compact('category', 'userProgress', 'completedQuizzes'));
    }

    public function play(Audio $audio)
    {
        $progress = UserProgress::firstOrCreate(
            [
                'user_id' => auth()->id(),
                'content_type' => Audio::class,
                'content_id' => $audio->id,
            ],
            ['status' => 'started', 'last_position' => 0]
        );

        return view('audio.player', compact('audio', 'progress'));
    }

    public function updateProgress(Request $request, Audio $audio)
    {
        $request->validate([
            'status' => 'required|in:started,completed',
            'last_position' => 'nullable|integer',
        ]);

        UserProgress::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'content_type' => Audio::class,
                'content_id' => $audio->id,
            ],
            [
                'status' => $request->status,
                'last_position' => $request->last_position ?? 0,
            ]
        );

        return response()->json(['message' => 'Progress saved']);
    }
}
