<x-admin-layout>
    <div class="mb-8">
        <a href="{{ route('admin.quizzes.index') }}" class="text-gray-500 hover:text-gray-700">← Kembali</a>
        <h1 class="text-3xl font-bold text-gray-800 mt-2">Edit Kuis: {{ $quiz->title }}</h1>
    </div>

    <div class="grid lg:grid-cols-2 gap-8">
        <!-- Quiz Details Form -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Detail Kuis</h2>
            <form action="{{ route('admin.quizzes.update', $quiz) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul Kuis</label>
                    <input type="text" name="title" value="{{ old('title', $quiz->title) }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Kategori</label>
                    <select name="category_id" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $quiz->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Link ke Audio</label>
                    <select name="audio_id"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        <option value="">-- Tidak terkait audio --</option>
                        @foreach($audios as $audio)
                            <option value="{{ $audio->id }}" {{ $quiz->audio_id == $audio->id ? 'selected' : '' }}>
                                {{ $audio->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Passing Score (%)</label>
                    <input type="number" name="passing_score" value="{{ old('passing_score', $quiz->passing_score) }}"
                        min="0" max="100" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>

                <button type="submit"
                    class="w-full px-6 py-4 bg-purple-600 text-white rounded-xl font-bold hover:bg-purple-700 transition">
                    💾 Update Kuis
                </button>
            </form>
        </div>

        <!-- Questions Section -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Pertanyaan ({{ $quiz->questions->count() }} soal)</h2>

            <!-- Add Question Form -->
            <form action="{{ route('admin.quizzes.addQuestion', $quiz) }}" method="POST"
                class="mb-6 p-4 bg-purple-50 rounded-xl">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Pertanyaan Baru</label>
                    <textarea name="question_text" rows="2" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500"
                        placeholder="Tulis pertanyaan di sini..."></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Opsi Jawaban</label>
                    <input type="text" name="options[]" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg mb-2" placeholder="Opsi A">
                    <input type="text" name="options[]" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg mb-2" placeholder="Opsi B">
                    <input type="text" name="options[]" class="w-full px-4 py-2 border border-gray-300 rounded-lg mb-2"
                        placeholder="Opsi C (opsional)">
                    <input type="text" name="options[]" class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                        placeholder="Opsi D (opsional)">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Jawaban Benar</label>
                    <select name="correct_answer" required class="w-full px-4 py-3 border border-gray-300 rounded-xl">
                        <option value="0">Opsi A</option>
                        <option value="1">Opsi B</option>
                        <option value="2">Opsi C</option>
                        <option value="3">Opsi D</option>
                    </select>
                </div>

                <button type="submit"
                    class="w-full px-4 py-3 bg-purple-600 text-white rounded-xl font-bold hover:bg-purple-700 transition">
                    + Tambah Pertanyaan
                </button>
            </form>

            <!-- Existing Questions -->
            <div class="space-y-4">
                @forelse($quiz->questions as $index => $question)
                    <div class="p-4 bg-gray-50 rounded-xl">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-sm font-bold text-purple-600">Soal {{ $index + 1 }}</span>
                            <form action="{{ route('admin.quizzes.deleteQuestion', [$quiz, $question]) }}" method="POST"
                                onsubmit="return confirm('Hapus pertanyaan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 text-sm hover:underline">Hapus</button>
                            </form>
                        </div>
                        <p class="text-gray-800 font-medium mb-2">{{ $question->text }}</p>
                        <div class="text-sm text-gray-600">
                            @foreach($question->options as $i => $option)
                                @if($option)
                                    <div class="{{ $i == $question->correct_answer ? 'text-green-600 font-bold' : '' }}">
                                        {{ chr(65 + $i) }}. {{ $option }} {{ $i == $question->correct_answer ? '✓' : '' }}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-gray-500">
                        Belum ada pertanyaan. Tambahkan pertanyaan di atas.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-admin-layout>