<x-app-layout>
    <div class="pb-5">
        <!-- Back Button -->
        <div class="px-4 pt-4 pb-2">
            <a href="{{ route('videos.index') }}"
                class="inline-flex items-center text-sm text-gray-500 hover:text-emerald-600 transition">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
        </div>

        <!-- Video Player (Full Width) -->
        <div class="bg-black relative" style="padding-top: 56.25%;">
            <iframe class="absolute top-0 left-0 w-full h-full"
                src="https://www.youtube.com/embed/{{ $video->youtube_id }}?rel=0" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
        </div>

        <!-- Video Info -->
        <div class="px-4 py-4 bg-white border-b border-gray-100">
            <h1 class="text-base font-bold text-gray-900 mb-1">{{ $video->title }}</h1>
            <p class="text-xs text-gray-500">Seri: <span
                    class="text-emerald-600 font-medium">{{ $video->category->name }}</span></p>

            <form action="{{ route('videos.complete', $video->id) }}" method="POST" class="mt-4">
                @csrf
                <button type="submit"
                    class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-emerald-600 text-white rounded-xl text-sm font-bold active:scale-95 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Tandai Selesai
                </button>
            </form>
        </div>

        <!-- Related Videos -->
        <div class="px-4 pt-4">
            <h3 class="text-sm font-bold text-gray-700 mb-3">Video Terkait</h3>
            <div class="space-y-3">
                @foreach($relatedVideos as $related)
                    <a href="{{ route('videos.show', $related->slug) }}"
                        class="flex bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition active:scale-[0.98]">
                        <div class="w-28 h-20 flex-shrink-0 relative bg-gray-200">
                            <img src="https://img.youtube.com/vi/{{ $related->youtube_id }}/mqdefault.jpg"
                                alt="{{ $related->title }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/20 flex items-center justify-center">
                                <div class="w-7 h-7 bg-red-600 rounded-full flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white ml-0.5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow p-3 flex flex-col justify-center">
                            <h4 class="text-xs font-semibold text-gray-800 line-clamp-2 leading-snug">{{ $related->title }}
                            </h4>
                            <span class="text-[10px] text-gray-400 mt-1">{{ $related->duration ?? '10:00' }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>