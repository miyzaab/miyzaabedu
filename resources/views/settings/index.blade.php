<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Pengaturan</h2>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">

                <!-- Display Settings -->
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                        </svg>
                        Tampilan & Zoom
                    </h3>

                    <div class="bg-gray-50 rounded-lg p-5" x-data="{ 
                        localZoom: localStorage.getItem('app_zoom') || 1 
                    }">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">Ukuran Tampilan</span>
                            <span class="text-xs font-bold text-emerald-600 bg-emerald-100 px-2 py-1 rounded"
                                x-text="Math.round(localZoom * 100) + '%'">100%</span>
                        </div>

                        <input type="range" min="0.8" max="1.2" step="0.05" x-model="localZoom"
                            @input="$dispatch('zoom-change', localZoom); localStorage.setItem('app_zoom', localZoom)"
                            class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-emerald-600">

                        <div class="flex justify-between text-xs text-gray-400 mt-2">
                            <span>Kecil (80%)</span>
                            <span>Normal (100%)</span>
                            <span>Besar (120%)</span>
                        </div>

                        <p class="text-xs text-gray-500 mt-4 italic">
                            *Geser untuk memperbesar atau memperkecil tampilan aplikasi. Pengaturan ini akan tersimpan
                            otomatis.
                        </p>
                    </div>
                </div>

                <!-- Account Settings Placeholder -->
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Akun
                    </h3>
                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition group">
                        <span class="text-sm font-medium text-gray-700">Edit Profil & Password</span>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>