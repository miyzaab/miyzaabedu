<x-app-layout>
    @php
        $audioUrl = str_starts_with($audio->file_path, 'http')
            ? $audio->file_path
            : asset($audio->file_path);
        $thumbnail = $audio->thumbnail ? asset('storage/' . $audio->thumbnail) : null;

        // Check if user has completed this audio before
        $hasCompletedOnce = $progress && $progress->status === 'completed';
        $startPosition = $progress->last_position ?? 0;
    @endphp

    <style>
        @keyframes barAnimate {

            0%,
            100% {
                transform: scaleY(0.4);
            }

            50% {
                transform: scaleY(1);
            }
        }

        .bar-animate {
            animation: barAnimate 0.8s ease-in-out infinite;
        }

        .bar-playing {
            animation: barAnimate 0.5s ease-in-out infinite;
        }
    </style>

    <div x-data="modernAudioPlayer('{{ $audioUrl }}', {{ $startPosition }}, '{{ route('audio.update-progress', $audio) }}', {{ $hasCompletedOnce ? 'true' : 'false' }}, {{ $audio->quiz ? $audio->quiz->id : 'null' }})"
        class="flex flex-col min-h-screen bg-white pb-20">

        <!-- Header -->
        <header class="flex items-center justify-between p-4 pt-6">
            <a href="{{ route('audio.show', $audio->category->slug) }}"
                class="flex items-center justify-center w-10 h-10 rounded-full text-gray-600 hover:bg-gray-100 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div class="flex flex-col items-center">
                <span class="text-xs uppercase tracking-widest text-gray-500 font-semibold">Sedang Diputar</span>
            </div>
            <div class="w-10"></div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col px-6 justify-center gap-4">
            <!-- Album Art -->
            <div class="relative w-full aspect-square max-w-[280px] mx-auto">
                <div class="absolute inset-4 blur-2xl opacity-30 rounded-full bg-emerald-500"
                    :class="{ 'animate-pulse': isPlaying }"></div>
                <div class="relative w-full h-full rounded-2xl overflow-hidden shadow-xl ring-1 ring-black/5">
                    @if($thumbnail)
                        <img src="{{ $thumbnail }}" alt="{{ $audio->title }}" class="w-full h-full object-cover">
                    @else
                        <div
                            class="w-full h-full bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center p-8">
                            <svg class="w-24 h-24 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                            </svg>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Title & Category -->
            <div class="flex flex-col items-center text-center mt-2 space-y-1">
                <h2 class="text-xl font-bold tracking-tight text-gray-900 truncate max-w-[280px]">{{ $audio->title }}
                </h2>
                <p class="text-base text-emerald-600 font-medium">{{ $audio->category->name }}</p>
            </div>


            <!-- Waveform Visualization -->
            <div class="w-full mt-2">
                <div class="flex items-end justify-center h-10 gap-[3px] mb-2">
                    <template x-for="(bar, index) in waveformBars" :key="index">
                        <div class="w-1 rounded-full transition-all duration-150"
                            :class="index < currentBarIndex ? 'bg-emerald-500' : 'bg-gray-200'"
                            :style="`height: ${bar}px`"></div>
                    </template>
                </div>

                <!-- Progress Bar -->
                <div class="relative w-full h-1.5 bg-gray-200 rounded-full cursor-pointer"
                    @click="seekIfAllowed($event)">
                    <div class="absolute top-0 left-0 h-full bg-emerald-500 rounded-full"
                        :style="`width: ${progress}%`"></div>
                    <div class="absolute top-1/2 -translate-y-1/2 w-4 h-4 bg-white border border-gray-200 rounded-full shadow-md -ml-2"
                        :style="`left: ${progress}%`"></div>
                </div>

                <!-- Time Display -->
                <div class="flex justify-between text-xs font-mono text-gray-500 mt-2">
                    <span x-text="formatTime(currentTime)">0:00</span>
                    <span x-text="formatTime(duration)">0:00</span>
                </div>
            </div>

            <!-- Playback Speed - Always visible -->
            <div class="flex justify-center my-2">
                <div class="flex items-center bg-gray-100 rounded-full p-1 gap-1">
                    <button @click="setPlaybackRate(0.5)"
                        class="px-3 py-1.5 rounded-full text-xs font-bold transition-all"
                        :class="playbackRate === 0.5 ? 'bg-emerald-500 text-white shadow' : 'text-gray-600 hover:bg-gray-200'">0.5x</button>
                    <button @click="setPlaybackRate(1)"
                        class="px-3 py-1.5 rounded-full text-xs font-bold transition-all"
                        :class="playbackRate === 1 ? 'bg-emerald-500 text-white shadow' : 'text-gray-600 hover:bg-gray-200'">1x</button>
                    <button @click="setPlaybackRate(1.5)"
                        class="px-3 py-1.5 rounded-full text-xs font-bold transition-all"
                        :class="playbackRate === 1.5 ? 'bg-emerald-500 text-white shadow' : 'text-gray-600 hover:bg-gray-200'">1.5x</button>
                    <button @click="setPlaybackRate(2)"
                        class="px-3 py-1.5 rounded-full text-xs font-bold transition-all"
                        :class="playbackRate === 2 ? 'bg-emerald-500 text-white shadow' : 'text-gray-600 hover:bg-gray-200'">2x</button>
                </div>
            </div>

            <!-- Playback Controls -->
            <div class="flex items-center justify-center gap-8 mt-4">
                <!-- Skip Back 15s - always allowed to go back -->
                <button @click="skipBackward"
                    class="text-gray-700 hover:text-emerald-600 transition-colors active:scale-95">
                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M11 18V6l-8.5 6 8.5 6zm.5-6l8.5 6V6l-8.5 6z" />
                    </svg>
                </button>

                <!-- Play/Pause -->
                <button @click="togglePlay"
                    class="flex items-center justify-center w-20 h-20 text-white rounded-full shadow-xl transition-all duration-200 active:scale-95"
                    :class="isPlaying ? 'bg-emerald-600' : 'bg-emerald-500'">
                    <svg x-show="!isPlaying" class="w-10 h-10 ml-1" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8 5v14l11-7z" />
                    </svg>
                    <svg x-show="isPlaying" class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z" />
                    </svg>
                </button>

                <!-- Skip Forward 15s -->
                <button @click="skipForwardIfAllowed" class="transition-colors active:scale-95"
                    :class="canSeek ? 'text-gray-700 hover:text-emerald-600' : 'text-gray-300 cursor-not-allowed'">
                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4 18l8.5-6L4 6v12zm9-12v12l8.5-6L13 6z" />
                    </svg>
                </button>
            </div>

            <!-- Completed Message -->
            <div x-show="completed || hasCompletedOnce" x-transition
                class="mt-4 p-4 bg-emerald-50 text-emerald-700 rounded-xl text-center text-sm font-medium border border-emerald-100">
                🎉 MashaAllah! Audio telah selesai didengarkan.
                @if($audio->quiz)
                    <button @click="goToQuiz()"
                        class="block w-full mt-3 px-4 py-2.5 bg-amber-500 text-white rounded-lg font-bold hover:bg-amber-600 transition">
                        📝 Kerjakan Kuis Sekarang
                    </button>
                @endif
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('modernAudioPlayer', (url, startPosition, updateUrl, completedOnce, quizId) => ({
                audio: null,
                isPlaying: false,
                duration: 0,
                currentTime: 0,
                progress: 0,
                completed: completedOnce, // If already completed, set completed to true
                playbackRate: 1,
                updateInterval: null,
                waveformBars: [],
                currentBarIndex: 0,
                hasCompletedOnce: completedOnce,
                maxPositionReached: startPosition,
                quizId: quizId,

                get canSeek() {
                    return this.hasCompletedOnce || this.completed;
                },

                init() {
                    // Generate random waveform bars
                    for (let i = 0; i < 35; i++) {
                        this.waveformBars.push(Math.floor(Math.random() * 28) + 12);
                    }

                    this.audio = new Audio(url);

                    // If already completed, start from beginning for replay
                    if (this.hasCompletedOnce) {
                        this.audio.currentTime = 0;
                    } else {
                        this.audio.currentTime = startPosition;
                    }

                    this.audio.addEventListener('loadedmetadata', () => {
                        this.duration = this.audio.duration;
                        // If completed, set max position to full duration
                        if (this.hasCompletedOnce) {
                            this.maxPositionReached = this.duration;
                        }
                    });

                    this.audio.addEventListener('timeupdate', () => {
                        this.currentTime = this.audio.currentTime;
                        this.progress = (this.currentTime / this.duration) * 100;
                        this.currentBarIndex = Math.floor((this.progress / 100) * this.waveformBars.length);

                        // Track max position reached
                        if (this.currentTime > this.maxPositionReached) {
                            this.maxPositionReached = this.currentTime;
                        }
                    });

                    this.audio.addEventListener('ended', () => {
                        this.isPlaying = false;
                        this.completed = true;
                        this.hasCompletedOnce = true;
                        this.maxPositionReached = this.duration;
                        this.saveProgress('completed');
                    });

                    this.updateInterval = setInterval(() => {
                        if (this.isPlaying) {
                            this.saveProgress('started');
                        }
                    }, 30000);
                },

                togglePlay() {
                    if (this.isPlaying) {
                        this.audio.pause();
                    } else {
                        this.audio.play();
                    }
                    this.isPlaying = !this.isPlaying;
                },

                seekIfAllowed(event) {
                    const rect = event.currentTarget.getBoundingClientRect();
                    const x = event.clientX - rect.left;
                    const percent = x / rect.width;
                    const targetTime = percent * this.duration;

                    if (this.canSeek) {
                        // Can seek anywhere after completion
                        this.audio.currentTime = targetTime;
                    } else {
                        // On first play, only allow seeking backwards to already played position
                        if (targetTime <= this.maxPositionReached) {
                            this.audio.currentTime = targetTime;
                        }
                    }
                },

                skipForwardIfAllowed() {
                    if (!this.canSeek) return;
                    this.audio.currentTime = Math.min(this.audio.currentTime + 15, this.duration);
                },

                skipBackward() {
                    this.audio.currentTime = Math.max(this.audio.currentTime - 15, 0);
                },

                setPlaybackRate(rate) {
                    this.playbackRate = rate;
                    this.audio.playbackRate = rate;
                },

                formatTime(seconds) {
                    if (isNaN(seconds)) return '0:00';
                    const m = Math.floor(seconds / 60);
                    const s = Math.floor(seconds % 60);
                    return `${m}:${s < 10 ? '0' : ''}${s}`;
                },

                async saveProgress(status) {
                    try {
                        const response = await fetch(updateUrl, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                status: status,
                                last_position: Math.floor(this.currentTime)
                            })
                        });
                        const data = await response.json();
                        console.log('Progress saved:', status, data);
                    } catch (error) {
                        console.error('Error saving progress:', error);
                    }
                },

                async goToQuiz() {
                    if (this.quizId) {
                        // Make sure completed status is saved before navigating
                        if (this.completed) {
                            await this.saveProgress('completed');
                        }
                        window.location.href = '/quiz/' + this.quizId;
                    }
                }
            }));
        });
    </script>
</x-app-layout>