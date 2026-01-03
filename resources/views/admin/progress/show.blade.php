<x-admin-layout>
    <div class="mb-8">
        <a href="{{ route('admin.progress.index') }}"
            class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">← Kembali ke Daftar
            User</a>
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white mt-2">Perkembangan: {{ $user->name }}</h1>
        <p class="text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
    </div>

    <!-- Progress Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Audio Progress -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg border-l-4 border-emerald-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Audio Selesai</p>
                    <h3 class="text-3xl font-bold text-emerald-600">{{ $audioCount }}</h3>
                </div>
                <div
                    class="h-12 w-12 rounded-full bg-emerald-100 dark:bg-emerald-900/50 flex items-center justify-center">
                    <span class="material-icons-outlined text-emerald-600 dark:text-emerald-400">headphones</span>
                </div>
            </div>
        </div>

        <!-- Video Progress -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Video Selesai</p>
                    <h3 class="text-3xl font-bold text-purple-600">{{ $videoCount }}</h3>
                </div>
                <div
                    class="h-12 w-12 rounded-full bg-purple-100 dark:bg-purple-900/50 flex items-center justify-center">
                    <span class="material-icons-outlined text-purple-600 dark:text-purple-400">play_circle</span>
                </div>
            </div>
        </div>

        <!-- Article Progress -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg border-l-4 border-orange-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Artikel Dibaca</p>
                    <h3 class="text-3xl font-bold text-orange-600">{{ $articleCount }}</h3>
                </div>
                <div
                    class="h-12 w-12 rounded-full bg-orange-100 dark:bg-orange-900/50 flex items-center justify-center">
                    <span class="material-icons-outlined text-orange-600 dark:text-orange-400">article</span>
                </div>
            </div>
        </div>

        <!-- Quiz Stats -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Rata-rata Score Kuis</p>
                    <h3 class="text-3xl font-bold text-blue-600">{{ number_format($quizStats['avg_score'], 1) }}%</h3>
                </div>
                <div class="h-12 w-12 rounded-full bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center">
                    <span class="material-icons-outlined text-blue-600 dark:text-blue-400">quiz</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quiz Progress Summary -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 mb-8">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Statistik Kuis</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 text-center">
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Kuis Dikerjakan</p>
                <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $quizStats['total'] }}</p>
            </div>
            <div class="bg-green-50 dark:bg-green-900/30 rounded-lg p-4 text-center">
                <p class="text-sm text-green-600 dark:text-green-400">Kuis Lulus</p>
                <p class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $quizStats['passed'] }}</p>
            </div>
            <div class="bg-red-50 dark:bg-red-900/30 rounded-lg p-4 text-center">
                <p class="text-sm text-red-600 dark:text-red-400">Kuis Tidak Lulus</p>
                <p class="text-2xl font-bold text-red-600 dark:text-red-400">{{ $quizStats['failed'] }}</p>
            </div>
        </div>
    </div>

    <!-- Quiz History Table -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
            <h2 class="text-xl font-bold text-gray-800 dark:text-white">Riwayat Kuis</h2>
        </div>
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-600 dark:text-gray-300">Nama Kuis</th>
                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-600 dark:text-gray-300">Score</th>
                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-600 dark:text-gray-300">Passing Score
                    </th>
                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-600 dark:text-gray-300">Status</th>
                    <th class="px-6 py-4 text-right text-sm font-bold text-gray-600 dark:text-gray-300">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($quizProgress as $progress)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                        <td class="px-6 py-4">
                            <div class="font-semibold text-gray-800 dark:text-white">
                                {{ $progress['quiz']->title ?? 'Kuis Dihapus' }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-xl font-bold {{ $progress['passed'] ? 'text-green-600' : 'text-red-600' }}">
                                {{ $progress['score'] ?? 0 }}%
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center text-gray-600 dark:text-gray-300">
                            {{ $progress['passing_score'] }}%
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($progress['passed'])
                                <span
                                    class="px-3 py-1 bg-green-100 dark:bg-green-900/50 text-green-700 dark:text-green-300 rounded-full text-sm font-semibold">
                                    ✓ Lulus
                                </span>
                            @else
                                <span
                                    class="px-3 py-1 bg-red-100 dark:bg-red-900/50 text-red-700 dark:text-red-300 rounded-full text-sm font-semibold">
                                    ✗ Tidak Lulus
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right text-gray-500 dark:text-gray-400">
                            {{ $progress['completed_at']->format('d M Y, H:i') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                            User belum mengerjakan kuis apapun.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>