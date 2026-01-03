<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::withCount('audios');

        // Filter by type
        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }

        // Get all categories first
        $categories = $query->orderBy('name')->get();

        // Sort categories by type preference
        $sort = $request->get('sort', '');

        if ($sort && in_array($sort, ['audio', 'video', 'article', 'quiz'])) {
            // Sort: selected type first, then others alphabetically by type and name
            $categories = $categories->sortBy(function ($category) use ($sort) {
                if ($category->type === $sort) {
                    return '0_' . $category->name; // Selected type first
                }
                return '1_' . $category->type . '_' . $category->name;
            })->values();
        } elseif ($sort === 'name_asc') {
            $categories = $categories->sortBy('name')->values();
        } elseif ($sort === 'name_desc') {
            $categories = $categories->sortByDesc('name')->values();
        } else {
            // Default: group by type, then alphabetically
            $categories = $categories->sortBy([
                ['type', 'asc'],
                ['name', 'asc'],
            ])->values();
        }

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:audio,video,article,quiz',
            'description' => 'nullable|string',
            'marhalah' => 'nullable|integer|min:1|max:6',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'type' => $request->type,
            'description' => $request->description,
            'marhalah' => $request->marhalah ?? 1,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:audio,video,article,quiz',
            'description' => 'nullable|string',
            'marhalah' => 'nullable|integer|min:1|max:6',
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'type' => $request->type,
            'description' => $request->description,
            'marhalah' => $request->marhalah ?? 1,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
