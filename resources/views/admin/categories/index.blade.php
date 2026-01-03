<x-admin-layout>
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Kelola Kategori</h1>
        <div class="flex gap-4">
            <form method="GET" action="{{ route('admin.categories.index') }}" class="flex items-center gap-2">
                <!-- Filter by Type -->
                <select name="type" onchange="this.form.submit()"
                    class="border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500 capitalize">
                    <option value="">Semua Tipe</option>
                    @foreach(['article', 'audio', 'video', 'quiz'] as $type)
                        <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                            {{ ucfirst($type) }}
                        </option>
                    @endforeach
                </select>
                
                <!-- Sort by Type -->
                <select name="sort" onchange="this.form.submit()"
                    class="border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Urutan Default</option>
                    <option value="audio" {{ request('sort') == 'audio' ? 'selected' : '' }}>Audio Dulu</option>
                    <option value="video" {{ request('sort') == 'video' ? 'selected' : '' }}>Video Dulu</option>
                    <option value="article" {{ request('sort') == 'article' ? 'selected' : '' }}>Article Dulu</option>
                    <option value="quiz" {{ request('sort') == 'quiz' ? 'selected' : '' }}>Quiz Dulu</option>
                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama A-Z</option>
                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama Z-A</option>
                </select>
            </form>
            <a href="{{ route('admin.categories.create') }}"
                class="px-6 py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition">
                + Tambah Kategori
            </a>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-600 dark:text-gray-300">Nama</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-600 dark:text-gray-300">Tipe</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-600 dark:text-gray-300">Marhalah</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-600 dark:text-gray-300">Jumlah</th>
                    <th class="px-6 py-4 text-right text-sm font-bold text-gray-600 dark:text-gray-300">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($categories as $category)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                        <td class="px-6 py-4">
                            <div class="font-semibold text-gray-800 dark:text-white">{{ $category->name }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">{{ $category->slug }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $colors = [
                                    'audio' => 'bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300',
                                    'video' => 'bg-purple-100 dark:bg-purple-900/50 text-purple-700 dark:text-purple-300',
                                    'article' => 'bg-blue-100 dark:bg-blue-900/50 text-blue-700 dark:text-blue-300',
                                    'quiz' => 'bg-amber-100 dark:bg-amber-900/50 text-amber-700 dark:text-amber-300',
                                ];
                            @endphp
                            <span class="px-3 py-1 {{ $colors[$category->type] ?? 'bg-gray-100 text-gray-700' }} rounded-full text-sm capitalize">
                                {{ $category->type }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($category->type == 'audio')
                                <span class="px-3 py-1 bg-teal-100 dark:bg-teal-900/50 text-teal-700 dark:text-teal-300 rounded-full text-sm font-medium">
                                    Marhalah {{ $category->marhalah ?? 1 }}
                                </span>
                            @else
                                <span class="text-gray-400 dark:text-gray-500">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-300">{{ $category->audios_count ?? 0 }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.categories.edit', $category) }}"
                                class="text-blue-600 dark:text-blue-400 hover:underline mr-3">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin hapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 dark:text-red-400 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                            Belum ada kategori. <a href="{{ route('admin.categories.create') }}"
                                class="text-blue-600 dark:text-blue-400 hover:underline">Tambah sekarang</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>