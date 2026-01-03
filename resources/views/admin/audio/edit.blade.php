<x-admin-layout>
    <div class="mb-8">
        <a href="{{ route('admin.audio.index') }}"
            class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">← Kembali</a>
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white mt-2">Edit Audio: {{ $audio->title }}</h1>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8 max-w-2xl">
        <form action="{{ route('admin.audio.update', $audio) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Judul Audio</label>
                <input type="text" name="title" value="{{ old('title', $audio->title) }}" required
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                @error('title')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <!-- Marhalah Selection -->
            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Marhalah</label>
                <select id="marhalah_select"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="">-- Semua Marhalah --</option>
                    @for($i = 1; $i <= 4; $i++)
                        <option value="{{ $i }}" {{ ($audio->category->marhalah ?? 1) == $i ? 'selected' : '' }}>Marhalah
                            {{ $i }}</option>
                    @endfor
                </select>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Pilih marhalah untuk memfilter kategori
                    (opsional)</p>
            </div>

            <!-- Category Selection -->
            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Kategori</label>
                <select name="category_id" id="category_select" required
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" data-marhalah="{{ $category->marhalah ?? 1 }}" {{ $audio->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }} (Marhalah {{ $category->marhalah ?? 1 }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Current Audio Info -->
            <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-xl">
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">File Audio Saat Ini</label>
                <div class="flex items-center space-x-3">
                    <span class="text-2xl">🎵</span>
                    <span class="text-sm text-gray-600 dark:text-gray-400 truncate">{{ $audio->file_path }}</span>
                </div>
                @if(str_starts_with($audio->file_path, 'storage/'))
                    <audio controls class="w-full mt-3">
                        <source src="{{ asset($audio->file_path) }}" type="audio/mpeg">
                    </audio>
                @endif
            </div>

            <!-- File Upload Section -->
            <div
                class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-900/30 rounded-xl border-2 border-dashed border-emerald-300 dark:border-emerald-600">
                <label class="block text-sm font-bold text-emerald-700 dark:text-emerald-400 mb-2">🎵 Upload File Audio
                    Baru (opsional)</label>
                <input type="file" name="audio_file"
                    accept="audio/mp3,audio/wav,audio/ogg,audio/m4a,.mp3,.wav,.ogg,.m4a"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-emerald-500">
                <p class="text-xs text-emerald-600 dark:text-emerald-400 mt-2">Format: MP3, WAV, OGG, M4A. Maks 50MB.
                    Biarkan kosong jika tidak ingin mengubah.</p>
                @error('audio_file')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="text-center text-gray-500 dark:text-gray-400 text-sm mb-4">— ATAU —</div>

            <!-- URL Input Section -->
            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">🔗 URL Audio Baru
                    (opsional)</label>
                <input type="url" name="file_url" value="{{ old('file_url') }}"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                    placeholder="https://example.com/audio.mp3">
            </div>

            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Durasi (detik)</label>
                    <input type="number" name="duration" value="{{ old('duration', $audio->duration) }}"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Urutan</label>
                    <input type="number" name="sequence_order"
                        value="{{ old('sequence_order', $audio->sequence_order) }}"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
            </div>

            <button type="submit"
                class="w-full px-6 py-4 bg-emerald-600 text-white rounded-xl font-bold hover:bg-emerald-700 transition">
                💾 Update Audio
            </button>
        </form>
    </div>

    <script>
        const marhalahSelect = document.getElementById('marhalah_select');
        const categorySelect = document.getElementById('category_select');
        const allOptions = Array.from(categorySelect.querySelectorAll('option[data-marhalah]'));

        marhalahSelect.addEventListener('change', function () {
            const selectedMarhalah = this.value;

            // Show/hide options based on marhalah
            allOptions.forEach(option => {
                if (!selectedMarhalah || option.dataset.marhalah === selectedMarhalah) {
                    option.style.display = '';
                } else {
                    option.style.display = 'none';
                    if (option.selected) {
                        categorySelect.value = '';
                    }
                }
            });
        });
    </script>
</x-admin-layout>