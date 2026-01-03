<x-admin-layout>
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Manajemen Pengguna</h1>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-600 dark:text-gray-300">Nama</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-600 dark:text-gray-300">Email</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-600 dark:text-gray-300">Terdaftar</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-600 dark:text-gray-300">Role</th>
                    <th class="px-6 py-4 text-right text-sm font-bold text-gray-600 dark:text-gray-300">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($users as $user)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <img class="h-10 w-10 rounded-full border border-gray-200 dark:border-gray-600 object-cover mr-3"
                                            src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random&color=fff' }}"
                                            alt="Avatar">
                                        <div class="font-semibold text-gray-800 dark:text-white">{{ $user->name }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600 dark:text-gray-300">{{ $user->email }}</td>
                                <td class="px-6 py-4 text-gray-500 dark:text-gray-400 text-sm">
                                    {{ $user->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-bold uppercase
                                                {{ $user->role === 'super_admin' ? 'bg-purple-100 dark:bg-purple-900/50 text-purple-700 dark:text-purple-300' :
                    ($user->role === 'admin' ? 'bg-blue-100 dark:bg-blue-900/50 text-blue-700 dark:text-blue-300' : 'bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300') }}">
                                        {{ str_replace('_', ' ', $user->role) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                        class="text-blue-600 dark:text-blue-400 hover:underline mr-3">Ubah Role</a>

                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Yakin hapus user ini? Tindakan ini tidak bisa dibatalkan.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 dark:text-red-400 hover:underline">Hapus</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                            Tidak ada pengguna ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700">
            {{ $users->links() }}
        </div>
    </div>
</x-admin-layout>