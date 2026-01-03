<x-admin-layout>
    <div class="mb-8">
        <a href="{{ route('admin.videos.index') }}" class="text-gray-500 hover:text-gray-700">← Kembali</a>
        <h1 class="text-3xl font-bold text-gray-800 mt-2">Edit Video: {{ $video->title }}</h1>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-8 max-w-2xl">
        <form action="{{ route('admin.videos.update', $video) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Judul Video</label>
                <input type="text" name="title" value="{{ old('title', $video->title) }}" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                @error('title')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Kategori</label>
                <select name="category_id" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $video->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Link Video YouTube (URL)</label>
                <input type="url" name="url" value="{{ old('url', $video->url) }}" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" rows="3"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500">{{ old('description', $video->description) }}</textarea>
            </div>

            <button type="submit"
                class="w-full px-6 py-4 bg-purple-600 text-white rounded-xl font-bold hover:bg-purple-700 transition">
                💾 Update Video
            </button>
        </form>
    </div>
</x-admin-layout>