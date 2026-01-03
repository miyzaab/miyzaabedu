<x-admin-layout>
    <div class="mb-8">
        <a href="{{ route('admin.users.index') }}" class="text-gray-500 hover:text-gray-700 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Manajemen Pengguna
        </a>
    </div>

    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg p-8">
        <div class="flex items-center gap-4 mb-8">
            <img class="h-16 w-16 rounded-full border border-gray-200 object-cover"
                src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random&color=fff' }}"
                alt="Avatar">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h1>
                <p class="text-gray-500">{{ $user->email }}</p>
            </div>
        </div>

        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Role Pengguna</label>
                <div class="space-y-3">
                    <label
                        class="flex items-center p-4 border rounded-xl cursor-pointer hover:bg-gray-50 transition {{ $user->role === 'user' ? 'border-emerald-500 bg-emerald-50' : 'border-gray-200' }}">
                        <input type="radio" name="role" value="user"
                            class="w-4 h-4 text-emerald-600 focus:ring-emerald-500" {{ $user->role === 'user' ? 'checked' : '' }}>
                        <div class="ml-3">
                            <span class="block font-bold text-gray-800">User (Pengguna Biasa)</span>
                            <span class="block text-sm text-gray-500">Hanya bisa akses halaman depan (Materi, Kuis,
                                dll).</span>
                        </div>
                    </label>

                    <label
                        class="flex items-center p-4 border rounded-xl cursor-pointer hover:bg-gray-50 transition {{ $user->role === 'admin' ? 'border-blue-500 bg-blue-50' : 'border-gray-200' }}">
                        <input type="radio" name="role" value="admin" class="w-4 h-4 text-blue-600 focus:ring-blue-500"
                            {{ $user->role === 'admin' ? 'checked' : '' }}>
                        <div class="ml-3">
                            <span class="block font-bold text-gray-800">Admin</span>
                            <span class="block text-sm text-gray-500">Bisa mengelola konten (Artikel, Audio, Video,
                                Kuis).</span>
                        </div>
                    </label>

                    <label
                        class="flex items-center p-4 border rounded-xl cursor-pointer hover:bg-gray-50 transition {{ $user->role === 'super_admin' ? 'border-purple-500 bg-purple-50' : 'border-gray-200' }}">
                        <input type="radio" name="role" value="super_admin"
                            class="w-4 h-4 text-purple-600 focus:ring-purple-500" {{ $user->role === 'super_admin' ? 'checked' : '' }}>
                        <div class="ml-3">
                            <span class="block font-bold text-gray-800">Super Admin</span>
                            <span class="block text-sm text-gray-500">Akses penuh termasuk mengelola role
                                pengguna.</span>
                        </div>
                    </label>
                </div>
                @error('role')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-3 bg-emerald-600 text-white font-bold rounded-xl hover:bg-emerald-700 transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>