<x-admin-layout>
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Kelola Video</h1>
        <div class="flex gap-4">
            <form method="GET" action="{{ route('admin.videos.index') }}" class="flex items-center gap-2">
                <select name="category_id" onchange="this.form.submit()"
                    class="border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg text-sm focus:ring-purple-500 focus:border-purple-500">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </form>
            <a href="{{ route('admin.videos.create') }}"
                class="px-6 py-3 bg-purple-600 text-white rounded-xl font-bold hover:bg-purple-700 transition">
                + Tambah Video
            </a>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-600 dark:text-gray-300">Judul</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-600 dark:text-gray-300">Kategori</th>
                    <th class="px-6 py-4 text-right text-sm font-bold text-gray-600 dark:text-gray-300">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($videos as $video)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                        <td class="px-6 py-4">
                            <div class="font-semibold text-gray-800 dark:text-white">{{ $video->title }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">{{ $video->slug }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="px-3 py-1 bg-purple-100 dark:bg-purple-900/50 text-purple-700 dark:text-purple-300 rounded-full text-sm">
                                {{ $video->category->name ?? '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.videos.edit', $video) }}"
                                class="text-blue-600 dark:text-blue-400 hover:underline mr-3">Edit</a>
                            <form action="{{ route('admin.videos.destroy', $video) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin hapus video ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 dark:text-red-400 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                            Belum ada video. <a href="{{ route('admin.videos.create') }}"
                                class="text-purple-600 dark:text-purple-400 hover:underline">Tambah sekarang</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>