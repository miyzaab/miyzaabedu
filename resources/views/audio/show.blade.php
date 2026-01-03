<x-app-layout>
    <style>
        .glass-effect {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
    </style>

    <div class="px-4 py-6 pb-24">
        <!-- Back Link -->
        <div class="mb-4">
            <a href="{{ route('audio.marhalah', $category->marhalah) }}"
                class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-emerald-600 transition">
                <span class="material-icons-outlined text-base">arrow_back</span>
                <span>Kembali ke Marhalah {{ $category->marhalah }}</span>
            </a>
        </div>

        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900">{{ $category->name }}</h2>
            <p class="text-gray-500 mt-1">{{ $category->description ?? 'Daftar materi audio untuk pelajaran ini.' }}</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-2 gap-4 mb-8">
            <div class="bg-emerald-500/10 rounded-xl p-4 flex items-center gap-3">
                <div
                    class="w-10 h-10 rounded-full bg-emerald-500 text-white flex items-center justify-center shadow-lg">
                    <span class="material-icons-outlined">headphones</span>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase font-semibold">Total Audio</p>
                    <p class="text-xl font-bold text-gray-900">{{ $category->audios->count() }}</p>
                </div>
            </div>
            <div class="bg-blue-500/10 rounded-xl p-4 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center shadow-lg">
                    <span class="material-icons-outlined">schedule</span>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase font-semibold">Durasi</p>
                    <p class="text-xl font-bold text-gray-900">
                        @php
                            $totalMinutes = $category->audios->sum('duration') / 60;
                        @endphp
                        {{ round($totalMinutes) }} Min
                    </p>
                </div>
            </div>
        </div>

        <!-- Audio List -->
        <div class="space-y-3">
            <h3 class="text-lg font-bold text-gray-800 mb-3">Daftar Audio</h3>

            @foreach($category->audios as $index => $audio)
                @php
                    $isLocked = false;
                    $isCompleted = false;

                    if (isset($userProgress[$audio->id]) && $userProgress[$audio->id]->status == 'completed') {
                        $isCompleted = true;
                    }

                    if ($index > 0) {
                        $prevAudio = $category->audios[$index - 1];
                        $prevCompleted = isset($userProgress[$prevAudio->id]) && $userProgress[$prevAudio->id]->status == 'completed';
                        if (!$prevCompleted) {
                            $isLocked = true;
                        }
                    }

                    $duration = gmdate("i", $audio->duration);
                @endphp

                <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 {{ $isLocked ? 'opacity-60' : '' }}">
                    <div class="flex items-center">
                        <!-- Number/Status Icon -->
                        <div
                            class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 mr-3 
                                {{ $isCompleted ? 'bg-emerald-100 text-emerald-600' : ($isLocked ? 'bg-gray-100 text-gray-400' : 'bg-emerald-100 text-emerald-600') }}">
                            @if($isLocked)
                                <span class="material-icons-outlined text-xl">lock</span>
                            @elseif($isCompleted)
                                <span class="material-icons-outlined text-xl">check_circle</span>
                            @else
                                <span class="font-bold text-sm">{{ $index + 1 }}</span>
                            @endif
                        </div>

                        <!-- Info -->
                        <div class="flex-grow min-w-0">
                            <h3 class="font-semibold text-gray-800 text-sm truncate">{{ $audio->title }}</h3>
                            <p class="text-[10px] text-gray-500">{{ $duration }} menit • Sesi {{ $index + 1 }}</p>
                        </div>

                        <!-- Action Button -->
                        <div class="flex-shrink-0 ml-2">
                            @if($isLocked)
                                <span class="px-3 py-1.5 text-[10px] bg-gray-100 text-gray-400 rounded-lg">Terkunci</span>
                            @else
                                <a href="{{ route('audio.play', $audio->id) }}"
                                    class="inline-flex items-center px-3 py-1.5 text-xs bg-emerald-600 text-white rounded-lg font-medium active:scale-95 transition">
                                    {{ $isCompleted ? 'Ulang' : 'Mulai' }}
                                    <span class="material-icons-outlined text-sm ml-1">play_arrow</span>
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Quiz Button (if completed and has quiz) -->
                    @if($isCompleted && $audio->quiz)
                        <div class="mt-3 pt-3 border-t border-gray-100">
                            @if(in_array($audio->quiz->id, $completedQuizzes ?? []))
                                <span class="inline-flex items-center text-[10px] text-emerald-600 font-medium">
                                    <span class="material-icons-outlined text-sm mr-1">check_circle</span>
                                    Kuis Selesai
                                </span>
                            @else
                                <a href="{{ route('quiz.show', $audio->quiz->id) }}"
                                    class="inline-flex items-center px-3 py-1.5 text-xs bg-amber-500 text-white rounded-lg font-medium active:scale-95 transition">
                                    <span class="material-icons-outlined text-sm mr-1">quiz</span>
                                    Kerjakan Kuis
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</x-app-layout>