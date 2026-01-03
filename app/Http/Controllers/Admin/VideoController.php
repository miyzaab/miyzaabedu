<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $query = Video::with('category')->latest();

        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $videos = $query->get();
        $categories = Category::where('type', 'video')->get();

        return view('admin.videos.index', compact('videos', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('type', 'video')->get();
        return view('admin.videos.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'url' => 'required|url',
            'description' => 'nullable|string',
        ]);

        $youtubeId = $this->extractYoutubeId($request->url);

        if (!$youtubeId) {
            return back()->withErrors(['url' => 'URL YouTube tidak valid.'])->withInput();
        }

        Video::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'category_id' => $request->category_id,
            'youtube_id' => $youtubeId,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.videos.index')->with('success', 'Video berhasil ditambahkan!');
    }

    public function edit(Video $video)
    {
        $categories = Category::where('type', 'video')->get();
        return view('admin.videos.edit', compact('video', 'categories'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'url' => 'required|url',
            'description' => 'nullable|string',
        ]);

        $youtubeId = $this->extractYoutubeId($request->url);

        if (!$youtubeId) {
            return back()->withErrors(['url' => 'URL YouTube tidak valid.'])->withInput();
        }

        $video->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'category_id' => $request->category_id,
            'youtube_id' => $youtubeId,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.videos.index')->with('success', 'Video berhasil diperbarui!');
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('admin.videos.index')->with('success', 'Video berhasil dihapus!');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = explode(',', $request->ids);
        Video::whereIn('id', $ids)->delete();

        return redirect()->route('admin.videos.index')->with('success', count($ids) . ' video berhasil dihapus!');
    }

    private function extractYoutubeId($url)
    {
        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/';
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }
        return null;
    }
}
