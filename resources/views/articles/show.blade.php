<x-app-layout>
    <div class="px-4 py-5">
        <!-- Back Button -->
        <a href="{{ route('articles.index') }}"
            class="inline-flex items-center text-sm text-gray-500 mb-4 hover:text-emerald-600 transition">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>

        <!-- Article Card -->
        <article class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
            <!-- Cover Image -->
            <div class="h-48 bg-emerald-50 flex items-center justify-center relative">
                @if($article->thumbnail)
                    <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}"
                        class="w-full h-full object-cover">
                @else
                    <svg class="w-16 h-16 text-emerald-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                @endif
            </div>

            <!-- Content -->
            <div class="p-5">
                <!-- Meta -->
                <div class="flex items-center flex-wrap gap-2 mb-3">
                    <span class="px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded-full text-[10px] font-bold">
                        {{ $article->category->name ?? 'Kajian' }}
                    </span>
                    <span class="text-[10px] text-gray-400">
                        {{ $article->created_at->translatedFormat('d F Y') }}
                    </span>
                </div>

                <!-- Title -->
                <h1 class="text-xl font-bold text-gray-900 leading-snug mb-4">
                    {{ $article->title }}
                </h1>

                <!-- Author -->
                <div class="flex items-center mb-5 pb-5 border-b border-gray-100">
                    <div
                        class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 font-bold text-sm mr-2">
                        {{ substr($article->author->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-800">{{ $article->author->name }}</p>
                        <p class="text-[10px] text-gray-400">Penulis</p>
                    </div>
                </div>

                <!-- Article Content -->
                <div class="prose prose-sm prose-emerald max-w-none text-gray-700 leading-relaxed">
                    {!! $article->content !!}
                </div>
            </div>
        </article>
    </div>
</x-app-layout>