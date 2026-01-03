<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['category', 'author'])->latest()->get();
        $categories = Category::where('type', 'article')->get();
        return view('articles.index', compact('articles', 'categories'));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)->with(['category', 'author'])->firstOrFail();

        // Simulating 'Mark as Read' logic could happen here or via API/Livewire
        // For now just showing the view

        return view('articles.show', compact('article'));
    }
}
