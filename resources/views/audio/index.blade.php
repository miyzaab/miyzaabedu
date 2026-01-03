<x-app-layout>
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
    
    <div class="px-6 py-6 pb-24">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Kajian Audio</h1>
            <p class="text-gray-500 text-sm leading-relaxed">
                Dengarkan ceramah dan kajian ilmiah untuk memperdalam ilmu agama Anda.
            </p>
        </div>

        <!-- Marhalah Cards -->
        <div class="space-y-4">
            @php 
                $marhalahIcons = [
                    1 => 'looks_one', 
                    2 => 'looks_two', 
                    3 => 'looks_3', 
                    4 => 'looks_4', 
                    5 => 'looks_5', 
                    6 => 'looks_6'
                ]; 
            @endphp
            
            @forelse($marhalahGroups as $level => $categories)
                <a href="{{ route('audio.marhalah', $level) }}" 
                   class="group block relative overflow-hidden rounded-2xl transition-all duration-300 hover:scale-[1.02] active:scale-[0.98]">
                    <div class="glass-card shadow-lg p-5 flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <!-- Number Icon -->
                            <div class="w-14 h-14 rounded-2xl bg-emerald-500/10 flex items-center justify-center text-emerald-600 group-hover:bg-emerald-500 group-hover:text-white transition-colors duration-300">
                                <span class="material-icons-round text-3xl">{{ $marhalahIcons[$level] ?? 'filter_' . $level }}</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg text-gray-800 mb-1">Marhalah {{ $level }}</h3>
                                <div class="flex items-center text-xs text-gray-500">
                                    <span class="material-icons-round text-[14px] mr-1">graphic_eq</span>
                                    <span>{{ $categories->sum('audios_count') }} Materi Audio</span>
                                </div>
                            </div>
                        </div>
                        <!-- Arrow -->
                        <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 group-hover:bg-emerald-500 group-hover:text-white transition-all duration-300">
                            <span class="material-icons-round text-lg">chevron_right</span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="text-center py-16 bg-white rounded-2xl shadow-sm border border-gray-100">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-emerald-100 mb-4">
                        <span class="material-icons-round text-3xl text-emerald-500">headphones</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Belum ada kategori</h3>
                    <p class="text-sm text-gray-500">Nantikan kajian audio menarik dari kami.</p>
                </div>
            @endforelse

            <!-- Coming Soon Text -->
            @if($marhalahGroups->count() > 0)
                <div class="pt-4 flex justify-center">
                    <p class="text-xs text-gray-400 font-medium">Marhalah selanjutnya akan segera hadir</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
</x-app-layout>