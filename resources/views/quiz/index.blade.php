<x-app-layout>
    <div class="px-4 py-5">
        <!-- Page Header -->
        <div class="mb-5">
            <h1 class="text-xl font-bold text-gray-900">Kuis & Ujian</h1>
            <p class="text-sm text-gray-500 mt-1">Uji pemahaman Anda setelah mempelajari materi</p>
        </div>

        <!-- Quiz List -->
        <div class="space-y-4">
            @forelse($quizzes as $quiz)
                @php
                    $isCompleted = isset($quizProgress[$quiz->id]) && $quizProgress[$quiz->id] === 'completed';
                    $audioRequired = $quiz->audio_id !== null;
                    $audioCompleted = $audioRequired ? in_array($quiz->audio_id, $audioProgress) : true;
                    $canTakeQuiz = $audioCompleted && !$isCompleted;
                @endphp
                <div
                    class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 {{ $isCompleted ? 'opacity-75' : '' }}">
                    <!-- Header Gradient -->
                    <div
                        class="h-20 bg-gradient-to-r {{ $isCompleted ? 'from-emerald-500 to-teal-500' : 'from-amber-500 to-orange-500' }} flex items-center justify-center relative">
                        @if($isCompleted)
                            <svg class="w-10 h-10 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        @else
                            <svg class="w-10 h-10 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        @endif
                        <span
                            class="absolute top-2 right-2 bg-white/20 backdrop-blur-sm px-2 py-0.5 rounded-full text-white text-[10px] font-bold">
                            {{ $quiz->questions()->count() }} Soal
                        </span>
                        @if($isCompleted)
                            <span
                                class="absolute top-2 left-2 bg-white px-2 py-0.5 rounded-full text-emerald-600 text-[10px] font-bold">
                                ✓ SELESAI
                            </span>
                        @endif
                    </div>
                    <!-- Content -->
                    <div class="p-4">
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="text-[10px] font-bold px-2 py-0.5 bg-amber-100 text-amber-700 rounded-full">
                                {{ $quiz->category->name ?? 'Umum' }}
                            </span>
                            @if($audioRequired && !$audioCompleted)
                                <span class="text-[10px] font-bold px-2 py-0.5 bg-red-100 text-red-600 rounded-full">
                                    🔒 Perlu Audio
                                </span>
                            @endif
                        </div>
                        <h3 class="text-base font-bold text-gray-800 mt-2">{{ $quiz->title }}</h3>

                        @if($quiz->audio)
                            <p class="text-xs text-gray-400 mt-1">
                                Audio: {{ $quiz->audio->title }}
                                @if($audioCompleted)
                                    <span class="text-emerald-500">✓</span>
                                @endif
                            </p>
                        @endif

                        <p class="text-xs text-gray-500 mt-1">Nilai kelulusan: {{ $quiz->passing_score }}%</p>

                        @auth
                            @if($isCompleted)
                                <a href="{{ route('quiz.show', $quiz->id) }}"
                                    class="mt-4 w-full inline-flex items-center justify-center px-4 py-2.5 bg-emerald-100 text-emerald-700 rounded-xl text-sm font-bold hover:bg-emerald-200 transition">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Lihat Hasil
                                </a>
                            @elseif(!$audioCompleted)
                                <a href="{{ route('audio.play', $quiz->audio) }}"
                                    class="mt-4 w-full inline-flex items-center justify-center px-4 py-2.5 bg-blue-500 text-white rounded-xl text-sm font-bold hover:bg-blue-600 transition">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" />
                                    </svg>
                                    Dengarkan Audio Dulu
                                </a>
                            @else
                                <a href="{{ route('quiz.show', $quiz->id) }}"
                                    class="mt-4 w-full inline-flex items-center justify-center px-4 py-2.5 bg-amber-500 text-white rounded-xl text-sm font-bold hover:bg-amber-600 transition active:scale-[0.98]">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    Mulai Kuis
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}"
                                class="mt-4 w-full inline-flex items-center justify-center px-4 py-2.5 bg-gray-200 text-gray-600 rounded-xl text-sm font-medium">
                                Login untuk Mengerjakan
                            </a>
                        @endauth
                    </div>
                </div>
            @empty
                <div class="text-center py-16 bg-white rounded-2xl shadow-sm border border-gray-100">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-amber-100 mb-4">
                        <svg class="w-8 h-8 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Belum ada kuis</h3>
                    <p class="text-sm text-gray-500">Nantikan kuis menarik dari kami.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>