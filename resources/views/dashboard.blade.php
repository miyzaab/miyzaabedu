<x-app-layout>
    <div class="pb-6">
        <!-- Header Greeting -->
        <!-- Header Greeting -->
        <div class="px-4 pt-6 pb-4 flex items-center justify-between">
            <div class="flex items-center">
                <img class="h-12 w-12 rounded-full border-2 border-emerald-100 shadow mr-3 object-cover"
                    src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=10b981&color=fff&size=96' }}"
                    alt="Avatar">
                <div>
                    <div>
                        <div class="flex items-center gap-1.5">
                            <h1 class="text-lg font-bold text-gray-900">Assalamualaikum,
                                {{ explode(' ', Auth::user()->name)[0] }}
                            </h1>
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}"
                                    class="text-emerald-500 hover:text-emerald-600 transition" title="Admin Panel">
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                        <p class="text-xs text-gray-500 font-medium">Mari tingkatkan iman hari ini.</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <button
                    class="w-9 h-9 bg-gray-100 rounded-full flex items-center justify-center hover:bg-gray-200 transition">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Stats Card - Peringkat, Nilai, Marhalah -->
        @php
            // Calculate user ranking
            $userId = Auth::id();
            $allUserScores = \App\Models\UserProgress::where('content_type', 'App\\Models\\Quiz')
                ->whereNotNull('score')
                ->selectRaw('user_id, AVG(score) as avg_score')
                ->groupBy('user_id')
                ->orderByDesc('avg_score')
                ->get();

            $userRank = $allUserScores->search(fn($item) => $item->user_id == $userId);
            $ranking = $userRank !== false ? $userRank + 1 : '-';

            // Calculate average score and check if user has any quiz scores
            $userQuizCount = \App\Models\UserProgress::where('user_id', $userId)
                ->where('content_type', 'App\\Models\\Quiz')
                ->whereNotNull('score')
                ->count();

            $hasQuizScores = $userQuizCount > 0;

            $userAvgScore = \App\Models\UserProgress::where('user_id', $userId)
                ->where('content_type', 'App\\Models\\Quiz')
                ->whereNotNull('score')
                ->avg('score') ?? 0;

            // Determine predikat - only show if user has quiz scores
            if (!$hasQuizScores) {
                $predikat = '-';
                $predikatColor = 'bg-gray-400 text-white';
            } elseif ($userAvgScore >= 90) {
                $predikat = 'Mumtaz';
                $predikatColor = 'bg-emerald-500 text-white';
            } elseif ($userAvgScore >= 75) {
                $predikat = 'Jayyid Jiddan';
                $predikatColor = 'bg-blue-500 text-white';
            } elseif ($userAvgScore >= 60) {
                $predikat = 'Jayyid';
                $predikatColor = 'bg-yellow-400 text-yellow-900';
            } else {
                $predikat = 'Rasib';
                $predikatColor = 'bg-red-500 text-white';
            }

            // Marhalah - for now static, can be dynamic later
            $marhalah = 1;
        @endphp
        <div class="px-4 mb-6">
            <div
                class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl p-5 text-white shadow-lg relative overflow-hidden transform hover:scale-[1.02] transition duration-300">
                <!-- Decorative -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2">
                </div>
                <div
                    class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2">
                </div>

                <!-- Top Row: Peringkat & Marhalah -->
                <div class="flex items-start justify-between mb-4 relative">
                    <div>
                        <p class="text-[10px] uppercase tracking-wider text-emerald-100 font-bold mb-1">Peringkat</p>
                        <div class="flex items-baseline gap-1">
                            <span class="text-4xl font-extrabold tracking-tight">{{ $ranking }}</span>
                            @if($ranking !== '-')
                                <span class="text-sm text-emerald-200 font-medium">dari {{ $allUserScores->count() }}
                                    santri</span>
                            @endif
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] uppercase tracking-wider text-emerald-100 font-bold mb-1">Marhalah</p>
                        <div class="flex items-center justify-end gap-1.5">
                            @for($i = 1; $i <= 4; $i++)
                                <div
                                    class="w-7 h-7 rounded-lg flex items-center justify-center text-xs font-bold transition-all
                                                    {{ $i <= $marhalah ? 'bg-white text-emerald-600 shadow-md' : 'bg-white/20 text-white/60' }}">
                                    {{ $i }}
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>

                <!-- Divider -->
                <div class="h-px bg-white/20 my-4"></div>

                <!-- Bottom Row: Rata-rata Nilai & Predikat -->
                <div class="flex items-center justify-between relative">
                    <div>
                        <p class="text-[10px] uppercase tracking-wider text-emerald-100 font-bold mb-1">Rata-rata Nilai
                        </p>
                        <div class="flex items-baseline gap-2">
                            <span
                                class="text-3xl font-extrabold tracking-tight">{{ number_format($userAvgScore, 1) }}</span>
                            <span class="text-sm text-emerald-200">/100</span>
                        </div>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase tracking-wider text-emerald-100 font-bold mb-1 text-right">
                            Predikat</p>
                        <div class="px-4 py-2 rounded-xl {{ $predikatColor }} font-bold text-sm shadow-lg">
                            {{ $predikat }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Access Icons - Modern Glassmorphism -->
        <div class="px-5 mb-6">
            <div class="grid grid-cols-4 gap-3">
                <!-- Audio -->
                <a href="{{ route('audio.index') }}" class="flex flex-col items-center group">
                    <div class="relative w-16 h-16 mb-2">
                        <!-- Glass Background -->
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-2xl shadow-lg shadow-emerald-200/50 group-hover:shadow-emerald-300/60 group-hover:scale-110 transition-all duration-300">
                        </div>
                        <div class="absolute inset-[2px] bg-white/20 backdrop-blur-sm rounded-[14px]"></div>
                        <!-- Icon -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-7 h-7 text-white drop-shadow-md" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 1a9 9 0 0 0-9 9v7c0 1.66 1.34 3 3 3h3v-8H5v-2c0-3.87 3.13-7 7-7s7 3.13 7 7v2h-4v8h3c1.66 0 3-1.34 3-3v-7a9 9 0 0 0-9-9z" />
                            </svg>
                        </div>
                    </div>
                    <span class="text-xs text-gray-700 font-semibold">Audio</span>
                </a>

                <!-- Artikel -->
                <a href="{{ route('articles.index') }}" class="flex flex-col items-center group">
                    <div class="relative w-16 h-16 mb-2">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-2xl shadow-lg shadow-blue-200/50 group-hover:shadow-blue-300/60 group-hover:scale-110 transition-all duration-300">
                        </div>
                        <div class="absolute inset-[2px] bg-white/20 backdrop-blur-sm rounded-[14px]"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-7 h-7 text-white drop-shadow-md" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4z" />
                            </svg>
                        </div>
                    </div>
                    <span class="text-xs text-gray-700 font-semibold">Artikel</span>
                </a>

                <!-- Kuis -->
                <a href="{{ route('quiz.index') }}" class="flex flex-col items-center group">
                    <div class="relative w-16 h-16 mb-2">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-amber-400 to-orange-500 rounded-2xl shadow-lg shadow-amber-200/50 group-hover:shadow-amber-300/60 group-hover:scale-110 transition-all duration-300">
                        </div>
                        <div class="absolute inset-[2px] bg-white/20 backdrop-blur-sm rounded-[14px]"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-7 h-7 text-white drop-shadow-md" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-1 9h-4v4h-2v-4H9V9h4V5h2v4h4v2z" />
                            </svg>
                        </div>
                    </div>
                    <span class="text-xs text-gray-700 font-semibold">Kuis</span>
                </a>

                <!-- Video -->
                <a href="{{ route('videos.index') }}" class="flex flex-col items-center group">
                    <div class="relative w-16 h-16 mb-2">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-rose-400 to-red-500 rounded-2xl shadow-lg shadow-rose-200/50 group-hover:shadow-rose-300/60 group-hover:scale-110 transition-all duration-300">
                        </div>
                        <div class="absolute inset-[2px] bg-white/20 backdrop-blur-sm rounded-[14px]"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-7 h-7 text-white drop-shadow-md" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                        </div>
                    </div>
                    <span class="text-xs text-gray-700 font-semibold">Video</span>
                </a>
            </div>
        </div>

        <!-- Lanjutkan Belajar -->
        <div class="mb-6">
            <div class="flex items-center justify-between px-5 mb-3">
                <h2 class="text-base font-bold text-gray-800">Lanjutkan Belajar</h2>
                <a href="{{ route('audio.index') }}" class="text-xs text-emerald-600 font-medium">Lihat Semua</a>
            </div>
            <div class="flex gap-4 overflow-x-auto px-5 pb-3 scrollbar-hide">
                @php
                    $audios = \App\Models\Audio::with('category')->take(3)->get();
                @endphp
                @forelse($audios as $audio)
                    <a href="{{ route('audio.play', $audio->id) }}"
                        class="flex-shrink-0 w-48 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden group">
                        <div
                            class="h-28 bg-gradient-to-br from-emerald-400 to-teal-500 relative flex items-center justify-center">
                            <span
                                class="absolute top-2 left-2 bg-emerald-700/50 backdrop-blur-md text-white text-[9px] px-2 py-0.5 rounded-full font-bold">Audio</span>
                            <svg class="w-12 h-12 text-white/50 group-hover:scale-105 transition duration-300"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 18v-6a9 9 0 0 1 18 0v6" />
                                <path
                                    d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z" />
                            </svg>
                        </div>
                        <div class="p-3">
                            <h3 class="text-sm font-bold text-gray-900 line-clamp-1 mb-0.5">{{ $audio->title }}</h3>
                            <p class="text-[10px] text-gray-500 mb-2 line-clamp-1">
                                {{ $audio->category->name ?? 'Audio' }}
                            </p>
                            <div>
                                <div class="w-full h-1.5 bg-gray-100 rounded-full">
                                    <div class="h-full bg-emerald-500 rounded-full" style="width: 0%"></div>
                                </div>
                                <span class="text-[9px] text-gray-400 mt-1 block font-medium">0% Selesai</span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div
                        class="flex-shrink-0 w-48 bg-gray-50 rounded-2xl p-6 text-center border-2 border-dashed border-gray-200">
                        <p class="text-xs text-gray-400 font-medium">Belum ada materi</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Konten Terbaru -->
        <div class="px-5">
            <h2 class="text-base font-bold text-gray-800 mb-3">Konten Terbaru</h2>
            <div class="space-y-3">
                @php
                    $articles = \App\Models\Article::with('category')->latest()->take(3)->get();
                @endphp
                @forelse($articles as $article)
                    <a href="{{ route('articles.show', $article->slug) }}"
                        class="flex items-center bg-white rounded-xl p-3 shadow-sm border border-gray-100 hover:shadow-md transition">
                        <div class="w-11 h-11 bg-blue-100 rounded-xl flex items-center justify-center mr-3 flex-shrink-0">
                            <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                        </div>
                        <div class="flex-grow min-w-0">
                            <div class="flex items-center gap-2 mb-0.5">
                                <span
                                    class="text-[9px] font-bold text-blue-600 uppercase bg-blue-50 px-1.5 py-0.5 rounded-md">ARTIKEL</span>
                                <span class="text-[9px] text-gray-400">•
                                    {{ $article->created_at->diffForHumans() }}</span>
                            </div>
                            <h3 class="text-sm font-bold text-gray-900 line-clamp-1">{{ $article->title }}</h3>
                            <p class="text-[10px] text-gray-500">{{ $article->category->name ?? 'Artikel' }}</p>
                        </div>
                        <svg class="w-4 h-4 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                @empty
                    <div class="text-center py-6 text-gray-400 text-xs">
                        Belum ada konten terbaru
                    </div>
                @endforelse

                @php
                    $videos = \App\Models\Video::with('category')->latest()->take(2)->get();
                @endphp
                @foreach($videos as $video)
                    <a href="{{ route('videos.show', $video->slug) }}"
                        class="flex items-center bg-white rounded-xl p-3 shadow-sm border border-gray-100 hover:shadow-md transition">
                        <div class="w-11 h-11 bg-red-100 rounded-xl flex items-center justify-center mr-3 flex-shrink-0">
                            <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                        </div>
                        <div class="flex-grow min-w-0">
                            <div class="flex items-center gap-2 mb-0.5">
                                <span
                                    class="text-[9px] font-bold text-red-600 uppercase bg-red-50 px-1.5 py-0.5 rounded-md">VIDEO</span>
                                <span class="text-[9px] text-gray-400">• {{ $video->duration ?? '10 Menit' }}</span>
                            </div>
                            <h3 class="text-sm font-bold text-gray-900 line-clamp-1">{{ $video->title }}</h3>
                            <p class="text-[10px] text-gray-500">{{ $video->category->name ?? 'Video' }}</p>
                        </div>
                        <svg class="w-4 h-4 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Welcome Popup - Shows only for NEW users (account created within last 5 minutes) -->
    @php
        $isNewUser = Auth::user()->created_at->diffInMinutes(now()) <= 5;
    @endphp

    @if($isNewUser)
        <div x-data="welcomePopup()" x-show="showWelcome" x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

            <!-- Backdrop -->
            <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="closeWelcome()"></div>

            <!-- Modal - More Compact -->
            <div class="relative bg-white rounded-2xl shadow-2xl max-w-[320px] w-full overflow-hidden my-auto"
                x-transition:enter="transition ease-out duration-300 delay-100"
                x-transition:enter-start="opacity-0 scale-90 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0">

                <!-- Header - Compact -->
                <div
                    class="relative bg-gradient-to-br from-emerald-500 to-teal-600 p-5 text-center text-white overflow-hidden">
                    <!-- Content -->
                    <div class="relative">
                        <div
                            class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-3 ring-2 ring-white/30">
                            <span class="text-2xl">🕌</span>
                        </div>
                        <h2 class="text-xl font-bold mb-0.5">أهلاً وسهلاً</h2>
                        <p class="text-emerald-100 text-xs font-medium">Ahlan wa Sahlan</p>
                    </div>
                </div>

                <!-- Body - Compact -->
                <div class="p-4 text-center">
                    <h3 class="text-base font-bold text-gray-800 mb-2">
                        Selamat Bergabung di <span class="text-emerald-600">MiyzaabEdu</span>! 🎉
                    </h3>
                    <p class="text-gray-600 text-xs leading-relaxed mb-4">
                        Semoga senantiasa Allah berikan kemudahan dalam mempelajari ilmu-ilmu Islam.
                    </p>

                    <div class="bg-emerald-50 rounded-lg p-3 mb-4 border border-emerald-100">
                        <p class="text-[11px] text-emerald-700 italic">
                            "Barangsiapa menempuh jalan untuk menuntut ilmu, Allah akan memudahkan baginya jalan menuju
                            surga."
                        </p>
                        <p class="text-[9px] text-emerald-600 mt-1 font-medium">— HR. Muslim</p>
                    </div>

                    <button @click="closeWelcome()"
                        class="w-full py-2.5 px-4 bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-bold text-sm rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 active:scale-[0.98]">
                        Mulai Belajar ✨
                    </button>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('welcomePopup', () => ({
                    showWelcome: false,

                    init() {
                        // Check if already seen in this session
                        const hasSeenWelcome = localStorage.getItem('miyzaab_welcome_{{ Auth::id() }}');
                        if (!hasSeenWelcome) {
                            // Show popup after a short delay
                            setTimeout(() => {
                                this.showWelcome = true;
                            }, 500);
                        }
                    },

                    closeWelcome() {
                        this.showWelcome = false;
                        // Mark as seen so it won't show again even if they refresh within 5 min
                        localStorage.setItem('miyzaab_welcome_{{ Auth::id() }}', 'true');
                    }
                }));
            });
        </script>
    @endif
</x-app-layout>