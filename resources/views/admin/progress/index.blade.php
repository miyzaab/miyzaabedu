<x-admin-layout>
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Perkembangan User</h1>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-600 dark:text-gray-300">User</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-600 dark:text-gray-300">Email</th>
                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-600 dark:text-gray-300">Kuis Dikerjakan
                    </th>
                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-600 dark:text-gray-300">Rata-rata Score
                    </th>
                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-600 dark:text-gray-300">Kuis Lulus</th>
                    <th class="px-6 py-4 text-right text-sm font-bold text-gray-600 dark:text-gray-300">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($users as $user)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div
                                    class="h-10 w-10 rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center text-white font-bold">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div class="ml-3">
                                    <div class="font-semibold text-gray-800 dark:text-white">{{ $user->name }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Bergabung
                                        {{ $user->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-300">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-center">
                            <span
                                class="px-3 py-1 bg-blue-100 dark:bg-blue-900/50 text-blue-700 dark:text-blue-300 rounded-full text-sm font-semibold">
                                {{ $user->quizzes_taken ?? 0 }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @php
                                $avgScore = $user->avg_score ?? 0;
                            @endphp
                            <span
                                class="px-3 py-1 rounded-full text-sm font-semibold {{ $avgScore >= 70 ? 'bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300' : ($avgScore >= 50 ? 'bg-yellow-100 dark:bg-yellow-900/50 text-yellow-700 dark:text-yellow-300' : 'bg-red-100 dark:bg-red-900/50 text-red-700 dark:text-red-300') }}">
                                {{ number_format($avgScore, 1) }}%
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span
                                class="px-3 py-1 bg-green-100 dark:bg-green-900/50 text-green-700 dark:text-green-300 rounded-full text-sm font-semibold">
                                {{ $user->quizzes_passed ?? 0 }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.progress.show', $user) }}"
                                class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white text-sm rounded-lg hover:bg-emerald-700 transition">
                                <span class="material-icons-outlined text-sm mr-1">visibility</span>
                                Lihat Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                            Belum ada user yang terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
        <div class="mt-6">
            {{ $users->links() }}
        </div>
    @endif
</x-admin-layout>