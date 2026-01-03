<x-admin-layout>
    <div class="mb-8">
        <a href="{{ route('admin.quizzes.index') }}" class="text-gray-500 hover:text-gray-700">← Kembali</a>
        <h1 class="text-3xl font-bold text-gray-800 mt-2">Tambah Kuis Baru</h1>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-8 max-w-2xl">
        <form action="{{ route('admin.quizzes.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Judul Kuis</label>
                <input type="text" name="title" value="{{ old('title') }}" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                    placeholder="Contoh: Kuis Fiqih Shalat">
                @error('title')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Kategori</label>
                <select name="category_id" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                <p class="text-xs text-gray-500 mt-1">Belum ada kategori? <a
                        href="{{ route('admin.categories.index') }}" class="text-purple-600 underline">Buat kategori
                        baru</a></p>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Link ke Audio (opsional)</label>
                <select name="audio_id"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    <option value="">-- Tidak terkait audio --</option>
                    @foreach($audios as $audio)
                        <option value="{{ $audio->id }}" {{ old('audio_id') == $audio->id ? 'selected' : '' }}>
                            {{ $audio->title }}
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">Jika dipilih, kuis akan muncul setelah audio selesai didengarkan
                </p>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Passing Score (%)</label>
                <input type="number" name="passing_score" value="{{ old('passing_score', 70) }}" min="0" max="100"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
            </div>

            <button type="submit"
                class="w-full px-6 py-4 bg-purple-600 text-white rounded-xl font-bold hover:bg-purple-700 transition">
                💾 Simpan Kuis
            </button>
        </form>
    </div>

    <div class="mt-8 bg-yellow-50 border border-yellow-200 rounded-xl p-6 max-w-2xl">
        <h3 class="font-bold text-yellow-800 mb-2">💡 Tips</h3>
        <p class="text-yellow-700 text-sm">Setelah membuat kuis, Anda bisa menambahkan pertanyaan melalui halaman Edit.
        </p>
    </div>
</x-admin-layout>