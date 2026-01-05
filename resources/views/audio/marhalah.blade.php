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
            <a href="{{ route('audio.index') }}"
                class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-emerald-600 transition">
                <span class="material-icons-outlined text-base">arrow_back</span>
                <span>Kembali ke Marhalah</span>
            </a>
        </div>

        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Marhalah {{ $level }}</h2>
            <p class="text-gray-500 mt-1">Daftar pelajaran dasar untuk pemula.</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-2 gap-4 mb-8">
            <div class="bg-emerald-500/10 rounded-xl p-4 flex items-center gap-3">
                <div
                    class="w-10 h-10 rounded-full bg-emerald-500 text-white flex items-center justify-center shadow-lg">
                    <span class="material-icons-outlined">library_books</span>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase font-semibold">Total Materi</p>
                    <p class="text-xl font-bold text-gray-900">{{ $categories->sum('audios_count') }}</p>
                </div>
            </div>
            <div class="bg-blue-500/10 rounded-xl p-4 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center shadow-lg">
                    <span class="material-icons-outlined">play_circle</span>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase font-semibold">Durasi</p>
                    @php
                        $totalSeconds = $categories->sum(function($cat) {
                            return $cat->audios->sum('duration') ?? 0;
                        });
                        $totalMinutes = ceil($totalSeconds / 60);
                    @endphp
                    <p class="text-xl font-bold text-gray-900">{{ $totalMinutes }} Min</p>
                </div>
            </div>
        </div>

        <!-- Pelajaran List -->
        <div class="space-y-4">
            <h3 class="text-lg font-bold text-gray-800 mb-3">Daftar Pelajaran</h3>

            @php
                $iconColors = [
                    ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600', 'icon' => 'mosque'],
                    ['bg' => 'bg-cyan-50', 'text' => 'text-cyan-600', 'icon' => 'accessibility_new'],
                    ['bg' => 'bg-amber-50', 'text' => 'text-amber-600', 'icon' => 'history_edu'],
                    ['bg' => 'bg-purple-50', 'text' => 'text-purple-600', 'icon' => 'format_quote'],
                    ['bg' => 'bg-rose-50', 'text' => 'text-rose-600', 'icon' => 'menu_book'],
                    ['bg' => 'bg-indigo-50', 'text' => 'text-indigo-600', 'icon' => 'auto_stories'],
                ];
            @endphp

            @forelse($categories as $index => $category)
                @php
                    $colorSet = $iconColors[$index % count($iconColors)];
                @endphp

                <a href="{{ route('audio.show', $category->slug) }}" class="group relative block">
                    <!-- Glow Effect -->
                    <div
                        class="absolute inset-0 bg-emerald-500/20 rounded-2xl blur-md transition-opacity opacity-0 group-hover:opacity-100 duration-300">
                    </div>

                    <div
                        class="relative bg-white border border-gray-100 rounded-2xl p-4 flex items-center justify-between shadow-sm hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center gap-4">
                            <!-- Icon -->
                            <div
                                class="w-14 h-14 rounded-xl {{ $colorSet['bg'] }} flex items-center justify-center {{ $colorSet['text'] }}">
                                <span class="material-icons-outlined text-3xl">{{ $colorSet['icon'] }}</span>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-gray-900 group-hover:text-emerald-600 transition-colors">
                                    {{ $category->name }}</h4>
                                <p class="text-sm text-gray-500">
                                    {{ Str::limit($category->description ?? 'Materi Pelajaran', 30) }}</p>
                                <div class="flex items-center gap-2 mt-1">
                                    <span
                                        class="text-xs bg-gray-100 px-2 py-0.5 rounded text-gray-500">{{ $category->audios_count }}
                                        Audio</span>
                                    @php
                                        $categorySeconds = $category->audios->sum('duration') ?? 0;
                                        $categoryMinutes = ceil($categorySeconds / 60);
                                    @endphp
                                    <span class="text-xs text-gray-400">• {{ $categoryMinutes }} min</span>
                                </div>
                            </div>
                        </div>
                        <!-- Arrow -->
                        <div
                            class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-emerald-500 group-hover:text-white transition-all">
                            <span class="material-icons-outlined text-sm">arrow_forward_ios</span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="text-center py-12 bg-white rounded-2xl shadow-sm border border-gray-100">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-gray-100 mb-4">
                        <span class="material-icons-outlined text-2xl text-gray-400">folder_off</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Belum ada pelajaran</h3>
                    <p class="text-sm text-gray-500">Pelajaran untuk Marhalah ini akan segera hadir.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</x-app-layout>