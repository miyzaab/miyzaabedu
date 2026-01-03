<x-admin-layout>
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Kelola Artikel</h1>
        <div class="flex gap-4">
            <form method="GET" action="{{ route('admin.articles.index') }}" class="flex items-center gap-2">
                <select name="category_id" onchange="this.form.submit()"
                    class="border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg text-sm focus:ring-orange-500 focus:border-orange-500">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </form>
            <a href="{{ route('admin.articles.create') }}"
                class="px-6 py-3 bg-orange-600 text-white rounded-xl font-bold hover:bg-orange-700 transition">
                + Tambah Artikel
            </a>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-600 dark:text-gray-300">Judul</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-600 dark:text-gray-300">Kategori</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-600 dark:text-gray-300">Penulis</th>
                    <th class="px-6 py-4 text-right text-sm font-bold text-gray-600 dark:text-gray-300">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($articles as $article)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                        <td class="px-6 py-4">
                            <div class="font-semibold text-gray-800 dark:text-white">{{ $article->title }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">{{ Str::limit($article->excerpt, 50) }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-orange-100 dark:bg-orange-900/50 text-orange-700 dark:text-orange-300 rounded-full text-sm">
                                {{ $article->category->name ?? '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-300">{{ $article->author->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.articles.edit', $article) }}"
                                class="text-blue-600 dark:text-blue-400 hover:underline mr-3">Edit</a>
                            <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin hapus artikel ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 dark:text-red-400 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                            Belum ada artikel. <a href="{{ route('admin.articles.create') }}"
                                class="text-orange-600 dark:text-orange-400 hover:underline">Tambah sekarang</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>