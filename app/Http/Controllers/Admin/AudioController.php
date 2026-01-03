<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Audio;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AudioController extends Controller
{
    public function index(Request $request)
    {
        $query = Audio::with('category')->latest();

        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        // Filter by marhalah (through category)
        if ($request->has('marhalah') && $request->marhalah != '') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('marhalah', $request->marhalah);
            });
        }

        $audios = $query->get();
        $categories = Category::where('type', 'audio')->get();

        return view('admin.audio.index', compact('audios', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('type', 'audio')->get();
        return view('admin.audio.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'audio_file' => 'nullable|file|mimes:mp3,wav,ogg,m4a|max:51200', // 50MB max
            'file_url' => 'nullable|url',
            'duration' => 'nullable|integer',
            'sequence_order' => 'nullable|integer',
        ]);

        // Determine file path from upload or URL
        // Determine file path from upload or URL
        $filePath = $request->file_url;
        $duration = $request->duration;

        if ($request->hasFile('audio_file')) {
            $path = $request->file('audio_file')->store('audio', 'public');
            $filePath = 'storage/' . $path; // Prepend storage for local files

            // Auto-detect duration
            try {
                $getID3 = new \getID3;
                $fileInfo = $getID3->analyze(storage_path('app/public/' . $path));
                if (isset($fileInfo['playtime_seconds'])) {
                    $duration = round($fileInfo['playtime_seconds']);
                }
            } catch (\Exception $e) {
                // Keep default or manual duration
            }
        }

        if (!$filePath) {
            return back()->withErrors(['audio_file' => 'Harap upload file audio atau masukkan URL'])->withInput();
        }

        Audio::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'category_id' => $request->category_id,
            'file_path' => $filePath,
            'duration' => $duration ?? 60,
            'sequence_order' => $request->sequence_order ?? 0,
        ]);

        return redirect()->route('admin.audio.index')->with('success', 'Audio berhasil ditambahkan!');
    }

    public function edit(Audio $audio)
    {
        $categories = Category::where('type', 'audio')->get();
        return view('admin.audio.edit', compact('audio', 'categories'));
    }

    public function update(Request $request, Audio $audio)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'audio_file' => 'nullable|file|mimes:mp3,wav,ogg,m4a|max:51200',
            'file_url' => 'nullable|url',
            'duration' => 'nullable|integer',
            'sequence_order' => 'nullable|integer',
        ]);

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . $audio->id,
            'category_id' => $request->category_id,
            'duration' => $request->duration ?? 60,
            'sequence_order' => $request->sequence_order ?? 0,
        ];

        // Handle file upload
        // Handle file upload
        if ($request->hasFile('audio_file')) {
            // Delete old file if it's a local file
            if ($audio->file_path && str_starts_with($audio->file_path, 'storage/')) {
                $oldPath = str_replace('storage/', '', $audio->file_path);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('audio_file')->store('audio', 'public');
            $data['file_path'] = 'storage/' . $path;

            // Auto-detect duration
            try {
                $getID3 = new \getID3;
                $fileInfo = $getID3->analyze(storage_path('app/public/' . $path));
                if (isset($fileInfo['playtime_seconds'])) {
                    $data['duration'] = round($fileInfo['playtime_seconds']);
                }
            } catch (\Exception $e) {
                // Keep existing or manual duration
            }

        } elseif ($request->file_url) {
            // If new URL provided, use it
            $data['file_path'] = $request->file_url;
        }
        // If neither provided, keep existing

        $audio->update($data);

        return redirect()->route('admin.audio.index')->with('success', 'Audio berhasil diperbarui!');
    }

    public function destroy(Audio $audio)
    {
        // Delete file if it's local
        if ($audio->file_path && str_starts_with($audio->file_path, 'storage/')) {
            $path = str_replace('storage/', '', $audio->file_path);
            Storage::disk('public')->delete($path);
        }
        $audio->delete();
        return redirect()->route('admin.audio.index')->with('success', 'Audio berhasil dihapus!');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = explode(',', $request->ids);
        $audios = Audio::whereIn('id', $ids)->get();

        foreach ($audios as $audio) {
            if ($audio->file_path && str_starts_with($audio->file_path, 'storage/')) {
                $path = str_replace('storage/', '', $audio->file_path);
                Storage::disk('public')->delete($path);
            }
            $audio->delete();
        }

        return redirect()->route('admin.audio.index')->with('success', count($ids) . ' audio berhasil dihapus!');
    }
}
