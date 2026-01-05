<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Audio;
use App\Models\UserProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with(['category', 'audio'])->get();
        $userId = Auth::id();

        // Get user's quiz progress
        $quizProgress = [];
        $audioProgress = [];

        if ($userId) {
            $quizProgress = UserProgress::where('user_id', $userId)
                ->where('content_type', Quiz::class)
                ->pluck('status', 'content_id')
                ->toArray();

            // Get completed audio IDs
            $audioProgress = UserProgress::where('user_id', $userId)
                ->where('content_type', Audio::class)
                ->where('status', 'completed')
                ->pluck('content_id')
                ->toArray();
        }

        return view('quiz.index', compact('quizzes', 'quizProgress', 'audioProgress'));
    }

    public function show(Quiz $quiz)
    {
        $userId = Auth::id();

        // Check if user has already attempted this quiz (regardless of pass/fail)
        $quizResult = UserProgress::where('user_id', $userId)
            ->where('content_type', Quiz::class)
            ->where('content_id', $quiz->id)
            ->first();

        // Block retake if quiz was already attempted
        $hasCompleted = $quizResult !== null;

        // If quiz is already attempted, show results directly (no retake)
        if ($hasCompleted) {
            return view('quiz.show', compact('quiz', 'hasCompleted', 'quizResult'));
        }

        // Only check audio completion for NEW quiz attempts
        if ($quiz->audio_id) {
            // Check if user has completed the audio
            $audioCompleted = UserProgress::where('user_id', $userId)
                ->where('content_type', Audio::class)
                ->where('content_id', $quiz->audio_id)
                ->where('status', 'completed')
                ->exists();

            if (!$audioCompleted) {
                // Redirect to audio player with message
                $audio = Audio::find($quiz->audio_id);
                if ($audio) {
                    return redirect()->route('audio.play', $audio)
                        ->with('error', 'Silakan selesaikan audio terlebih dahulu sebelum mengerjakan kuis.');
                }
            }
        }

        return view('quiz.show', compact('quiz', 'hasCompleted', 'quizResult'));
    }
}
