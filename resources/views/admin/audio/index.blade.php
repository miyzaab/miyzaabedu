<x-admin-layout>
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Kelola Audio</h1>
        <div class="flex gap-4">
            <form method="GET" action="{{ route('admin.audio.index') }}" class="flex items-center gap-2">
                <!-- Filter by Marhalah -->
                <select name="marhalah" onchange="this.form.submit()"
                    class="border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg text-sm focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="">Semua Marhalah</option>
                    @for($i = 1; $i <= 4; $i++)
                        <option value="{{ $i }}" {{ request('marhalah') == $i ? 'selected' : '' }}>
                            Marhalah {{ $i }}
                        </option>
                    @endfor
                </select>

                <!-- Filter by Category -->
                <select name="category_id" onchange="this.form.submit()"
                    class="border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg text-sm focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </form>
            <a href="{{ route('admin.audio.create') }}"
                class="px-6 py-3 bg-emerald-600 text-white rounded-xl font-bold hover:bg-emerald-700 transition">
                + Tambah Audio
            </a>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-600 dark:text-gray-300">Judul</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-600 dark:text-gray-300">Kategori</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-600 dark:text-gray-300">Marhalah</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-600 dark:text-gray-300">Durasi</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-600 dark:text-gray-300">Urutan</th>
                    <th class="px-6 py-4 text-right text-sm font-bold text-gray-600 dark:text-gray-300">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($audios as $audio)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                        <td class="px-6 py-4">
                            <div class="font-semibold text-gray-800 dark:text-white">{{ $audio->title }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">{{ $audio->slug }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300 rounded-full text-sm">
                                {{ $audio->category->name ?? '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="px-3 py-1 bg-teal-100 dark:bg-teal-900/50 text-teal-700 dark:text-teal-300 rounded-full text-sm font-medium">
                                Marhalah {{ $audio->category->marhalah ?? 1 }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-300">{{ gmdate("i:s", $audio->duration) }}</td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-300">{{ $audio->sequence_order }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.audio.edit', $audio) }}"
                                class="text-blue-600 dark:text-blue-400 hover:underline mr-3">Edit</a>
                            <form action="{{ route('admin.audio.destroy', $audio) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin hapus audio ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 dark:text-red-400 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                            Belum ada audio. <a href="{{ route('admin.audio.create') }}"
                                class="text-emerald-600 dark:text-emerald-400 hover:underline">Tambah sekarang</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>