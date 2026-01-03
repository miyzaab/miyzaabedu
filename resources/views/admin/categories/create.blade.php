<x-admin-layout>
    <div class="mb-8">
        <a href="{{ route('admin.categories.index') }}"
            class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">← Kembali</a>
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white mt-2">Tambah Kategori Baru</h1>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8 max-w-2xl">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nama Kategori</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Contoh: Aqidah">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Tipe Konten</label>
                <select name="type" required
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Pilih Tipe --</option>
                    <option value="audio" {{ old('type') == 'audio' ? 'selected' : '' }}>Audio</option>
                    <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Video</option>
                    <option value="article" {{ old('type') == 'article' ? 'selected' : '' }}>Artikel</option>
                </select>
                @error('type')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Marhalah Field -->
            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Marhalah (Level)</label>
                <select name="marhalah"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @for($i = 1; $i <= 6; $i++)
                        <option value="{{ $i }}" {{ old('marhalah', 1) == $i ? 'selected' : '' }}>Marhalah {{ $i }}</option>
                    @endfor
                </select>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Khusus untuk kategori tipe Audio. Marhalah
                    menentukan tingkatan pelajaran.</p>
                @error('marhalah')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Deskripsi
                    (opsional)</label>
                <textarea name="description" rows="3"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Deskripsi singkat kategori...">{{ old('description') }}</textarea>
            </div>

            <button type="submit"
                class="w-full px-6 py-4 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition">
                💾 Simpan Kategori
            </button>
        </form>
    </div>
</x-admin-layout>