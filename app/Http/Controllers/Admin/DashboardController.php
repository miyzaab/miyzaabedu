<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Audio;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\Article;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'audio_count' => Audio::count(),
            'category_count' => Category::count(),
            'quiz_count' => Quiz::count(),
            'article_count' => Article::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
