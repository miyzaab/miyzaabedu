<x-admin-layout>
    <div class="space-y-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div
                class="bg-card-light dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex items-center justify-between group relative overflow-hidden">
                <div
                    class="absolute right-0 top-0 w-24 h-24 bg-gradient-to-br from-emerald-500/10 to-teal-500/10 rounded-bl-full -mr-4 -mt-4 transition-all duration-500 group-hover:scale-150">
                </div>
                <div class="relative z-10">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Total Audio</p>
                    <h3 class="text-3xl font-bold text-gradient">{{ \App\Models\Audio::count() ?? 1 }}</h3>
                </div>
                <div
                    class="relative z-10 h-12 w-12 rounded-full bg-gradient-to-br from-emerald-100 to-teal-100 dark:from-emerald-900/30 dark:to-teal-900/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                    <span
                        class="material-icons-outlined text-emerald-600 dark:text-emerald-400 text-2xl group-hover:animate-float">music_note</span>
                </div>
            </div>
            <div
                class="bg-card-light dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex items-center justify-between group relative overflow-hidden">
                <div
                    class="absolute right-0 top-0 w-24 h-24 bg-gradient-to-br from-blue-500/10 to-indigo-500/10 rounded-bl-full -mr-4 -mt-4 transition-all duration-500 group-hover:scale-150">
                </div>
                <div class="relative z-10">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Total Kategori</p>
                    <h3
                        class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-blue-400 dark:to-indigo-400">
                        {{ \App\Models\Category::count() ?? 8 }}
                    </h3>
                </div>
                <div
                    class="relative z-10 h-12 w-12 rounded-full bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <span
                        class="material-icons-outlined text-blue-600 dark:text-blue-400 text-2xl group-hover:rotate-12 transition-transform">folder</span>
                </div>
            </div>
            <div
                class="bg-card-light dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex items-center justify-between group relative overflow-hidden">
                <div
                    class="absolute right-0 top-0 w-24 h-24 bg-gradient-to-br from-purple-500/10 to-pink-500/10 rounded-bl-full -mr-4 -mt-4 transition-all duration-500 group-hover:scale-150">
                </div>
                <div class="relative z-10">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Total Kuis</p>
                    <h3
                        class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600 dark:from-purple-400 dark:to-pink-400">
                        {{ \App\Models\Quiz::count() ?? 1 }}
                    </h3>
                </div>
                <div
                    class="relative z-10 h-12 w-12 rounded-full bg-purple-50 dark:bg-purple-900/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <span
                        class="material-icons-outlined text-purple-600 dark:text-purple-400 text-2xl group-hover:-rotate-12 transition-transform">edit_note</span>
                </div>
            </div>
            <div
                class="bg-card-light dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex items-center justify-between group relative overflow-hidden">
                <div
                    class="absolute right-0 top-0 w-24 h-24 bg-gradient-to-br from-orange-500/10 to-red-500/10 rounded-bl-full -mr-4 -mt-4 transition-all duration-500 group-hover:scale-150">
                </div>
                <div class="relative z-10">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Total Artikel</p>
                    <h3
                        class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-orange-600 to-red-600 dark:from-orange-400 dark:to-red-400">
                        {{ \App\Models\Article::count() ?? 1 }}
                    </h3>
                </div>
                <div
                    class="relative z-10 h-12 w-12 rounded-full bg-orange-50 dark:bg-orange-900/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <span
                        class="material-icons-outlined text-orange-600 dark:text-orange-400 text-2xl group-hover:animate-pulse">newspaper</span>
                </div>
            </div>
        </div>
        <div class="space-y-4">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center group">
                <span
                    class="material-icons-outlined mr-2 text-gray-500 group-hover:text-yellow-500 transition-colors duration-300">flash_on</span>
                Aksi Cepat
            </h2>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('admin.audio.create') }}"
                    class="inline-flex items-center justify-center px-6 py-3 font-medium text-white rounded-lg shadow-md bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 hover:shadow-lg hover:scale-105 active:scale-95 transition-all duration-300">
                    <span class="material-icons-outlined mr-2 text-sm">music_note</span>
                    Tambah Audio
                </a>
                <a href="{{ route('admin.categories.create') }}"
                    class="inline-flex items-center justify-center px-6 py-3 font-medium text-white rounded-lg shadow-md bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 hover:shadow-lg hover:scale-105 active:scale-95 transition-all duration-300">
                    <span class="material-icons-outlined mr-2 text-sm">folder</span>
                    Tambah Kategori
                </a>
            </div>
        </div>
        <div
            class="bg-card-light dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div
                class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center bg-gray-50/50 dark:bg-gray-800/50">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Aktivitas Terbaru</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                            <th
                                class="px-6 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Aktivitas</th>
                            <th
                                class="px-6 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                User</th>
                            <th
                                class="px-6 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Tanggal</th>
                            <th
                                class="px-6 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors group">
                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300 group-hover:text-primary transition-colors">
                                Menambahkan Kategori Baru</td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400 flex items-center gap-2">
                                <div
                                    class="h-6 w-6 rounded-full bg-gradient-to-br from-blue-100 to-indigo-100 text-blue-600 flex items-center justify-center text-xs font-bold">
                                    A</div>
                                Admin
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">12 Feb 2024
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-emerald-100 to-teal-100 text-emerald-800 dark:from-emerald-900/50 dark:to-teal-900/50 dark:text-emerald-200 border border-emerald-200 dark:border-emerald-800">
                                    Selesai
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>