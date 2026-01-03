<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Audio;
use App\Models\Category;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index(Request $request)
    {
        $query = Quiz::with(['audio', 'category'])->withCount('questions')->latest();

        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $quizzes = $query->get();
        // Fetch categories for filter dropdown
        $categories = Category::where('type', 'quiz')->get();
        if ($categories->isEmpty()) {
            $categories = Category::all();
        }

        return view('admin.quizzes.index', compact('quizzes', 'categories'));
    }

    public function create()
    {
        $audios = Audio::all();
        // Fetch categories of type 'quiz', or fallback to all if empty (to avoid empty dropdown initially)
        $categories = Category::where('type', 'quiz')->get();
        if ($categories->isEmpty()) {
            $categories = Category::all();
        }
        return view('admin.quizzes.create', compact('audios', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'audio_id' => 'nullable|exists:audios,id',
            'passing_score' => 'required|integer|min:0|max:100',
        ]);

        Quiz::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'audio_id' => $request->audio_id,
            'passing_score' => $request->passing_score,
        ]);

        return redirect()->route('admin.quizzes.index')->with('success', 'Kuis berhasil ditambahkan!');
    }

    public function edit(Quiz $quiz)
    {
        $audios = Audio::all();
        $categories = Category::where('type', 'quiz')->get();
        if ($categories->isEmpty()) {
            $categories = Category::all();
        }
        $quiz->load('questions');
        return view('admin.quizzes.edit', compact('quiz', 'audios', 'categories'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'audio_id' => 'nullable|exists:audios,id',
            'passing_score' => 'required|integer|min:0|max:100',
        ]);

        $quiz->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'audio_id' => $request->audio_id,
            'passing_score' => $request->passing_score,
        ]);

        return redirect()->route('admin.quizzes.index')->with('success', 'Kuis berhasil diperbarui!');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->questions()->delete();
        $quiz->delete();
        return redirect()->route('admin.quizzes.index')->with('success', 'Kuis berhasil dihapus!');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = explode(',', $request->ids);
        $quizzes = Quiz::whereIn('id', $ids)->get();

        foreach ($quizzes as $quiz) {
            $quiz->questions()->delete();
            $quiz->delete();
        }

        return redirect()->route('admin.quizzes.index')->with('success', count($ids) . ' kuis berhasil dihapus!');
    }

    // Question management
    public function addQuestion(Request $request, Quiz $quiz)
    {
        $request->validate([
            'question_text' => 'required|string',
            'options' => 'required|array|min:2',
            'correct_answer' => 'required|integer|min:0',
        ]);

        $quiz->questions()->create([
            'text' => $request->question_text,
            'options' => $request->options,
            'correct_answer' => $request->correct_answer,
        ]);

        return back()->with('success', 'Pertanyaan berhasil ditambahkan!');
    }

    public function deleteQuestion(Quiz $quiz, Question $question)
    {
        $question->delete();
        return back()->with('success', 'Pertanyaan berhasil dihapus!');
    }
}
