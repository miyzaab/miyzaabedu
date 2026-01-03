<div class="fixed bottom-0 left-0 right-0 z-50 flex justify-center w-full pointer-events-none">
    <div class="w-full bg-white border-t border-gray-100 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] pointer-events-auto"
        style="max-width: 480px;">
        <div class="grid grid-cols-5 h-16">
            <!-- Dashboard - Modern Home Icon -->
            <a href="{{ route('dashboard') }}"
                class="flex flex-col items-center justify-center space-y-0.5 {{ request()->routeIs('dashboard') ? 'text-emerald-600' : 'text-gray-400 hover:text-emerald-500' }}">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                    <polyline points="9 22 9 12 15 12 15 22" />
                </svg>
                <span class="text-[10px] font-medium">Beranda</span>
            </a>

            <!-- Articles - Modern Book Icon -->
            <a href="{{ route('articles.index') }}"
                class="flex flex-col items-center justify-center space-y-0.5 {{ request()->routeIs('articles.*') ? 'text-emerald-600' : 'text-gray-400 hover:text-emerald-500' }}">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20" />
                    <path d="M8 7h6" />
                    <path d="M8 11h8" />
                </svg>
                <span class="text-[10px] font-medium">Artikel</span>
            </a>

            <!-- Audio - Modern Headphones Icon -->
            <a href="{{ route('audio.index') }}"
                class="flex flex-col items-center justify-center space-y-0.5 {{ request()->routeIs('audio.*') ? 'text-emerald-600' : 'text-gray-400 hover:text-emerald-500' }}">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 18v-6a9 9 0 0 1 18 0v6" />
                    <path
                        d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z" />
                </svg>
                <span class="text-[10px] font-medium">Audio</span>
            </a>

            <!-- Video - Modern Play Icon -->
            <a href="{{ route('videos.index') }}"
                class="flex flex-col items-center justify-center space-y-0.5 {{ request()->routeIs('videos.*') ? 'text-emerald-600' : 'text-gray-400 hover:text-emerald-500' }}">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="2" />
                    <path d="m9 8 6 4-6 4Z" />
                </svg>
                <span class="text-[10px] font-medium">Video</span>
            </a>

            <!-- Kuis - Modern Brain/Quiz Icon -->
            <a href="{{ route('quiz.index') }}"
                class="flex flex-col items-center justify-center space-y-0.5 {{ request()->routeIs('quiz.*') ? 'text-emerald-600' : 'text-gray-400 hover:text-emerald-500' }}">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                    <path d="M12 17h.01" />
                </svg>
                <span class="text-[10px] font-medium">Kuis</span>
            </a>
        </div>
    </div>
</div>