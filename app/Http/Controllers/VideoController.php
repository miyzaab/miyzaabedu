<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Category;
use App\Models\UserProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function index()
    {
        // Group videos by Category
        $categories = Category::where('type', 'video')->with(['videos'])->get();
        return view('videos.index', compact('categories'));
    }

    public function show($slug)
    {
        $video = Video::where('slug', $slug)->firstOrFail();
        $relatedVideos = Video::where('category_id', $video->category_id)->where('id', '!=', $video->id)->take(3)->get();

        return view('videos.show', compact('video', 'relatedVideos'));
    }

    public function markAsCompleted(Request $request, Video $video)
    {
        UserProgress::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'content_type' => Video::class,
                'content_id' => $video->id,
            ],
            [
                'status' => 'completed',
                'score' => null
            ]
        );

        return back()->with('success', 'Video ditandai selesai.');
    }
}
