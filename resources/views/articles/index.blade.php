<x-app-layout>
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    <div class="px-6 py-6 pb-24">
        <!-- Page Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Pustaka Ilmu</h1>
            <p class="text-gray-500 text-sm leading-relaxed">
                Telusuri artikel pilihan berdasarkan kategori ilmu untuk memperkaya wawasan Anda.
            </p>
        </div>

        <!-- Category Filter Tabs -->
        <div class="mb-8 overflow-x-auto no-scrollbar -mx-6 px-6 pb-2">
            <div class="flex gap-3" id="categoryTabs">
                <button onclick="filterCategory('all')" 
                    class="category-tab active whitespace-nowrap rounded-full px-5 py-2.5 text-sm font-semibold bg-emerald-500 text-white shadow-lg transition-all active:scale-95"
                    data-category="all">
                    Semua
                </button>
                @foreach($categories ?? [] as $category)
                    <button onclick="filterCategory('{{ $category->slug }}')"
                        class="category-tab whitespace-nowrap rounded-full px-5 py-2.5 text-sm font-medium bg-white text-gray-600 border border-gray-200 shadow-sm hover:border-emerald-500 hover:text-emerald-600 transition-all active:scale-95"
                        data-category="{{ $category->slug }}">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>
        </div>

        @php
            $categoryColors = [
                'fiqih' => 'bg-emerald-500',
                'aqidah' => 'bg-blue-500',
                'sirah' => 'bg-orange-500',
                'sejarah' => 'bg-orange-500',
                'adab' => 'bg-purple-500',
                'akhlak' => 'bg-purple-500',
                'hadits' => 'bg-amber-500',
                'tafsir' => 'bg-teal-500',
            ];
            
            // Group articles by category
            $groupedArticles = $articles->groupBy(function($article) {
                return $article->category->name ?? 'Umum';
            });
        @endphp

        <!-- Articles Grouped by Category -->
        @forelse($groupedArticles as $categoryName => $categoryArticles)
            @php
                $catSlug = strtolower($categoryName);
                $barColor = $categoryColors[$catSlug] ?? 'bg-emerald-500';
            @endphp
            
            <section class="mb-8 category-section" data-category="{{ Str::slug($categoryName) }}">
                <!-- Section Header -->
                <div class="flex items-center justify-between mb-4 px-1">
                    <div class="flex items-center gap-2">
                        <div class="w-1 h-5 {{ $barColor }} rounded-full"></div>
                        <h2 class="text-lg font-bold text-gray-900">{{ $categoryName }}</h2>
                    </div>
                    <a href="{{ route('articles.index', ['category' => Str::slug($categoryName)]) }}" 
                       class="text-xs font-semibold text-emerald-600 hover:text-emerald-700 transition-colors flex items-center gap-1">
                        Lihat Semua
                        <span class="material-icons-outlined text-sm">chevron_right</span>
                    </a>
                </div>

                <!-- Article Cards -->
                <div class="space-y-4">
                    @foreach($categoryArticles->take(2) as $article)
                        <a href="{{ route('articles.show', $article->slug) }}"
                            class="group block relative overflow-hidden rounded-2xl transition-all duration-300 hover:-translate-y-1 active:scale-[0.99] bg-white shadow-sm hover:shadow-lg border border-gray-100">
                            <div class="flex flex-row h-32">
                                <!-- Thumbnail -->
                                <div class="w-1/3 h-full relative overflow-hidden">
                                    @if($article->thumbnail)
                                        <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-emerald-50 to-emerald-100 flex items-center justify-center">
                                            <span class="material-icons-outlined text-4xl text-emerald-300">article</span>
                                        </div>
                                    @endif
                                    <div class="absolute inset-0 bg-gradient-to-r from-black/10 to-transparent"></div>
                                </div>
                                
                                <!-- Content -->
                                <div class="w-2/3 p-4 flex flex-col justify-between">
                                    <div>
                                        <!-- Title -->
                                        <h3 class="font-bold text-[15px] leading-snug text-gray-800 line-clamp-2 mb-1 group-hover:text-emerald-600 transition-colors">
                                            {{ $article->title }}
                                        </h3>
                                        <!-- Short Description -->
                                        <p class="text-xs text-gray-500 line-clamp-1">
                                            {{ Str::limit(strip_tags($article->content), 50) }}
                                        </p>
                                    </div>
                                    <!-- Footer -->
                                    <div class="flex items-center justify-between mt-2">
                                        <span class="text-[11px] text-gray-400 font-medium flex items-center gap-1">
                                            <span class="material-icons-outlined text-xs">schedule</span>
                                            {{ $article->created_at->diffForHumans() }}
                                        </span>
                                        <!-- Arrow Button -->
                                        <div class="w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center group-hover:bg-emerald-500 transition-colors">
                                            <span class="material-icons-outlined text-sm text-emerald-600 group-hover:text-white transition-colors">arrow_forward</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @empty
            <div class="text-center py-16 bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-emerald-100 mb-4">
                    <span class="material-icons-outlined text-3xl text-emerald-500">article</span>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-1">Belum ada artikel</h3>
                <p class="text-sm text-gray-500">Nantikan artikel menarik dari kami.</p>
            </div>
        @endforelse
    </div>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <script>
        function filterCategory(category) {
            const tabs = document.querySelectorAll('.category-tab');
            const sections = document.querySelectorAll('.category-section');
            
            // Update tab styles
            tabs.forEach(tab => {
                if (tab.dataset.category === category) {
                    tab.classList.remove('bg-white', 'text-gray-600', 'border', 'border-gray-200');
                    tab.classList.add('bg-emerald-500', 'text-white', 'shadow-lg');
                } else {
                    tab.classList.add('bg-white', 'text-gray-600', 'border', 'border-gray-200');
                    tab.classList.remove('bg-emerald-500', 'text-white', 'shadow-lg');
                }
            });
            
            // Filter sections
            sections.forEach(section => {
                if (category === 'all' || section.dataset.category === category) {
                    section.style.display = 'block';
                } else {
                    section.style.display = 'none';
                }
            });
        }
    </script>
</x-app-layout>