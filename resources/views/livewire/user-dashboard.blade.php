<div class="space-y-8">

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white/10 backdrop-blur-md border border-white/20 p-6 rounded-2xl shadow-lg">
            <h3 class="text-gray-500 text-sm font-medium">Audio Selesai</h3>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['audio_completed'] }}</p>
        </div>
        <div class="bg-white/10 backdrop-blur-md border border-white/20 p-6 rounded-2xl shadow-lg">
            <h3 class="text-gray-500 text-sm font-medium">Video Selesai</h3>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['video_completed'] }}</p>
        </div>
        <div class="bg-white/10 backdrop-blur-md border border-white/20 p-6 rounded-2xl shadow-lg">
            <h3 class="text-gray-500 text-sm font-medium">Artikel Dibaca</h3>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['article_read'] }}</p>
        </div>
        <div class="bg-white/10 backdrop-blur-md border border-white/20 p-6 rounded-2xl shadow-lg">
            <h3 class="text-gray-500 text-sm font-medium">Kuis Diambil</h3>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['quizzes_taken'] }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Grade Center -->
        <div class="lg:col-span-2 bg-white/50 backdrop-blur-md border border-white/20 rounded-2xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-6">Grade Center</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="pb-3 text-gray-500 font-medium">Quiz</th>
                            <th class="pb-3 text-gray-500 font-medium">Tanggal</th>
                            <th class="pb-3 text-gray-500 font-medium">Nilai</th>
                            <th class="pb-3 text-gray-500 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($quiz_results as $result)
                            <tr>
                                <td class="py-3 font-medium text-gray-800">{{ $result['quiz_title'] }}</td>
                                <td class="py-3 text-gray-600">{{ $result['date'] }}</td>
                                <td class="py-3 font-bold text-indigo-600">{{ $result['score'] }}</td>
                                <td class="py-3">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-semibold {{ $result['status'] === 'Lulus' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $result['status'] }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-4 text-center text-gray-500">Belum ada data kuis.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Global Score Chart -->
        <div class="bg-white/50 backdrop-blur-md border border-white/20 rounded-2xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-6">Global Score</h3>
            <div wire:ignore id="chart"></div>
        </div>
    </div>

    <!-- ApexCharts Script -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            var options = {
                series: [{
                    name: 'Rata-rata Nilai',
                    data: @json($global_score['scores'])
                }],
                chart: {
                    height: 350,
                    type: 'radar',
                    toolbar: { show: false }
                },
                xaxis: {
                    categories: @json($global_score['categories'])
                },
                fill: {
                    opacity: 0.5,
                    colors: ['#6366f1']
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['#6366f1']
                },
                markers: {
                    size: 4,
                    colors: ['#fff'],
                    strokeColors: '#6366f1',
                    strokeWidth: 2,
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        });
    </script>
</div>