<x-app-layout>
    <div class="pb-6">
        <!-- Profile Header -->
        <div class="bg-white px-4 pt-6 pb-8 text-center">
            <!-- Avatar with Upload -->
            <div class="relative inline-block mb-4" x-data="{ uploading: false }">
                <img class="h-24 w-24 rounded-full border-4 border-emerald-100 shadow-lg mx-auto object-cover"
                    src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=10b981&color=fff&size=128' }}"
                    alt="Avatar" id="avatar-preview">
                
                <!-- Upload Button -->
                <form action="{{ route('profile.photo') }}" method="POST" enctype="multipart/form-data" id="photo-form">
                    @csrf
                    <label for="photo-input" class="absolute bottom-0 right-0 w-8 h-8 bg-emerald-500 rounded-full border-2 border-white flex items-center justify-center cursor-pointer hover:bg-emerald-600 transition">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </label>
                    <input type="file" id="photo-input" name="photo" class="hidden" accept="image/*" 
                        onchange="document.getElementById('photo-form').submit();">
                </form>
            </div>

            @if(session('status') === 'photo-updated')
                <p class="text-xs text-emerald-600 mb-2">Foto profil berhasil diperbarui!</p>
            @endif
            @error('photo')
                <p class="text-xs text-red-600 mb-2">{{ $message }}</p>
            @enderror

            <!-- Name & Info -->
            <h1 class="text-xl font-bold text-gray-900">{{ Auth::user()->name }}</h1>
            <p class="text-sm text-gray-500 mt-1">Pelajar • Bergabung
                {{ Auth::user()->created_at->translatedFormat('F Y') }}</p>
        </div>

        <!-- Stats Cards -->
        @php
            $userId = Auth::id();
            
            // Get total accumulated quiz score (sum of all quiz scores)
            $totalQuizScore = \App\Models\UserProgress::where('user_id', $userId)
                ->where('content_type', \App\Models\Quiz::class)
                ->whereNotNull('score')
                ->sum('score');
            
            // Get completed quizzes count
            $completedQuizzes = \App\Models\UserProgress::where('user_id', $userId)
                ->where('content_type', \App\Models\Quiz::class)
                ->where('status', 'completed')
                ->count();
            
            // Get completed audio count
            $completedAudio = \App\Models\UserProgress::where('user_id', $userId)
                ->where('content_type', \App\Models\Audio::class)
                ->where('status', 'completed')
                ->count();
        @endphp
        <div class="px-4 -mt-4">
            <div class="grid grid-cols-2 gap-3 mb-3">
                <!-- Total Nilai Kuis -->
                <div class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl p-4 text-white shadow-lg">
                    <div class="text-2xl font-bold">{{ $totalQuizScore }}</div>
                    <div class="text-xs text-emerald-100 flex items-center mt-1">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        TOTAL NILAI KUIS
                    </div>
                </div>
                <!-- Kuis Selesai -->
                <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100">
                    <div class="text-2xl font-bold text-gray-800">{{ $completedQuizzes }}</div>
                    <div class="text-xs text-gray-500 mt-1">KUIS SELESAI</div>
                </div>
            </div>
            <!-- Audio Selesai -->
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 text-center">
                <div class="text-2xl font-bold text-gray-800">{{ $completedAudio }}</div>
                <div class="text-xs text-gray-500 mt-1">AUDIO SELESAI</div>
            </div>
        </div>

        <!-- Aktivitas Mingguan -->
        <div class="px-4 mt-5">
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-sm font-bold text-gray-700">Aktivitas Mingguan</h3>
                    <span class="text-[10px] text-gray-400">•••</span>
                </div>
                <div class="flex items-baseline gap-2 mb-4">
                    <span class="text-2xl font-bold text-gray-800">+{{ rand(50, 200) }}</span>
                    <span
                        class="text-xs text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded">+{{ rand(5, 20) }}%</span>
                </div>
                <!-- Simple Chart Visualization -->
                <div class="flex items-end justify-between h-16 gap-1">
                    @php $days = ['SEN', 'SEL', 'RAB', 'KAM', 'JUM', 'SAB', 'MIN']; @endphp
                    @foreach($days as $i => $day)
                        @php $height = rand(20, 100);
                        $isToday = $i == now()->dayOfWeek - 1; @endphp
                        <div class="flex-1 flex flex-col items-center">
                            <div class="w-full bg-gradient-to-t {{ $isToday ? 'from-emerald-500 to-teal-400' : 'from-gray-200 to-gray-100' }} rounded-t"
                                style="height: {{ $height }}%"></div>
                            <span
                                class="text-[8px] {{ $isToday ? 'text-emerald-600 font-bold' : 'text-gray-400' }} mt-1">{{ $day }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Lanjutkan Belajar -->
        <div class="mt-5">
            <div class="flex items-center justify-between px-4 mb-3">
                <h3 class="text-sm font-bold text-gray-800">Lanjutkan Belajar</h3>
                <a href="{{ route('audio.index') }}" class="text-xs text-emerald-600 font-medium">Lihat Semua</a>
            </div>
            <div class="flex gap-3 overflow-x-auto px-4 pb-2 scrollbar-hide">
                @php
                    $recentProgress = collect();
                @endphp
                @forelse($recentProgress as $progress)
                    <a href="{{ route('audio.play', $progress->audio_id) }}"
                        class="flex-shrink-0 w-44 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl p-4 text-white shadow-lg">
                        <span class="text-[10px] uppercase tracking-wide text-emerald-200">AUDIO</span>
                        <h4 class="font-bold text-sm mt-1 line-clamp-2">{{ $progress->audio->title ?? 'Materi Audio' }}</h4>
                        <p class="text-[10px] text-emerald-100 mt-1">Lanjutkan dari
                            {{ gmdate("i:s", $progress->last_position ?? 0) }}</p>
                        <button
                            class="mt-3 w-full bg-white text-emerald-600 py-1.5 rounded-lg text-xs font-bold flex items-center justify-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                            Lanjut
                        </button>
                    </a>
                @empty
                    <div class="flex-shrink-0 w-44 bg-gray-100 rounded-2xl p-4 text-center">
                        <p class="text-xs text-gray-500">Belum ada progress</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Menu Pintas -->
        <div class="px-4 mt-5">
            <h3 class="text-sm font-bold text-gray-800 mb-3">Menu Pintas</h3>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden divide-y divide-gray-100">
                <!-- Profil -->
                <a href="#profile-section" class="flex items-center p-4 hover:bg-gray-50 transition">
                    <div class="w-9 h-9 bg-emerald-100 rounded-xl flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="flex-grow">
                        <div class="text-sm font-semibold text-gray-800">Profil</div>
                        <div class="text-[10px] text-gray-500">Ubah data diri & akun</div>
                    </div>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
                <!-- Kursus -->
                <a href="{{ route('audio.index') }}" class="flex items-center p-4 hover:bg-gray-50 transition">
                    <div class="w-9 h-9 bg-purple-100 rounded-xl flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div class="flex-grow">
                        <div class="text-sm font-semibold text-gray-800">Kursus</div>
                        <div class="text-[10px] text-gray-500">Lihat katalog pelajaran</div>
                    </div>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
                <!-- Pencapaian -->
                <a href="{{ route('quiz.index') }}" class="flex items-center p-4 hover:bg-gray-50 transition">
                    <div class="w-9 h-9 bg-amber-100 rounded-xl flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                    <div class="flex-grow">
                        <div class="text-sm font-semibold text-gray-800">Pencapaian</div>
                        <div class="text-[10px] text-gray-500">Lihat lencana & sertifikat</div>
                    </div>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
                <!-- Pengaturan -->
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex items-center p-4 hover:bg-gray-50 transition">
                        <div class="w-9 h-9 bg-gray-100 rounded-xl flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div class="flex-grow text-left">
                            <div class="text-sm font-semibold text-gray-800">Pengaturan</div>
                            <div class="text-[10px] text-gray-500">Aplikasi & notifikasi</div>
                        </div>
                        <svg class="w-4 h-4 text-gray-400 transition" :class="open ? 'rotate-90' : ''" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <!-- Settings Dropdown -->
                    <div x-show="open" x-collapse class="bg-gray-50 px-4 pb-4">
                        <div class="space-y-3" id="profile-section">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200 space-y-3">
                            @include('profile.partials.update-password-form')
                        </div>
                        <div class="mt-4 pt-4 border-t border-red-100">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Logout Button -->
        <div class="px-4 mt-5">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full bg-red-50 text-red-600 py-3 rounded-xl text-sm font-semibold hover:bg-red-100 transition flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Keluar dari Akun
                </button>
            </form>
        </div>
    </div>
</x-app-layout>