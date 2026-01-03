<x-app-layout>
    <div class="px-4 py-5">
        <!-- Page Header -->
        <div class="mb-5">
            <h1 class="text-xl font-bold text-gray-900">Video Kajian</h1>
            <p class="text-sm text-gray-500 mt-1">Tonton video pembelajaran Islam</p>
        </div>

        <!-- Video List by Category -->
        <div class="space-y-6">
            @forelse($categories as $category)
                @if($category->videos->count() > 0)
                    <div>
                        <h3 class="text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">{{ $category->name }}</h3>
                        <div class="space-y-3">
                            @foreach($category->videos as $video)
                                <a href="{{ route('videos.show', $video->slug) }}"
                                    class="block bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition active:scale-[0.98]">
                                    <div class="flex">
                                        <!-- Thumbnail -->
                                        <div class="w-32 h-20 flex-shrink-0 relative bg-gray-200">
                                            <img src="https://img.youtube.com/vi/{{ $video->youtube_id }}/mqdefault.jpg"
                                                alt="{{ $video->title }}" class="w-full h-full object-cover">
                                            <div class="absolute inset-0 bg-black/20 flex items-center justify-center">
                                                <div
                                                    class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center shadow-lg">
                                                    <svg class="w-4 h-4 text-white ml-0.5" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M8 5v14l11-7z" />
                                                    </svg>
                                                </div>
                                            </div>
                                            @if($video->duration)
                                                <span
                                                    class="absolute bottom-1 right-1 px-1.5 py-0.5 bg-black/70 text-white text-[10px] rounded">{{ $video->duration }}</span>
                                            @endif
                                        </div>
                                        <!-- Info -->
                                        <div class="flex-grow p-3 flex flex-col justify-center">
                                            <h4 class="text-sm font-semibold text-gray-800 line-clamp-2 leading-snug">
                                                {{ $video->title }}</h4>
                                            <span class="text-[10px] text-gray-400 mt-1">Tonton →</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            @empty
                <div class="text-center py-16 bg-white rounded-2xl shadow-sm border border-gray-100">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-red-100 mb-4">
                        <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Belum ada video</h3>
                    <p class="text-sm text-gray-500">Nantikan video kajian menarik dari kami.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>