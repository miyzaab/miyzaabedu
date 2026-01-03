<x-app-layout>
    <div class="px-4 py-5">
        <!-- Back Button -->
        <a href="{{ route('quiz.index') }}"
            class="inline-flex items-center text-sm text-gray-500 mb-4 hover:text-emerald-600 transition">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>

        @if($hasCompleted)
            <!-- Review Mode - Show completed quiz result -->
            <div class="bg-white rounded-2xl shadow-xl p-6 text-center">
                <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>

                <h2 class="text-xl font-bold text-gray-800 mb-2">Kuis Sudah Diselesaikan</h2>
                <p class="text-gray-500 mb-4">Anda sudah mengerjakan kuis ini sebelumnya.</p>

                <div class="bg-emerald-50 rounded-xl p-6 mb-6">
                    <p class="text-sm text-emerald-600 uppercase tracking-wide font-semibold mb-1">Nilai Anda</p>
                    <div class="text-5xl font-black text-emerald-600">
                        {{ $quizResult->score ?? 0 }}
                        <span class="text-xl text-gray-400">/100</span>
                    </div>
                    <p class="text-sm text-gray-500 mt-2">
                        Status:
                        <span
                            class="font-semibold {{ $quizResult->status === 'completed' ? 'text-emerald-600' : 'text-red-500' }}">
                            {{ $quizResult->status === 'completed' ? 'LULUS' : 'TIDAK LULUS' }}
                        </span>
                    </p>
                </div>

                <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 text-amber-700 text-sm">
                    ⚠️ Kuis hanya bisa dikerjakan satu kali. Anda tidak dapat mengulang kuis ini.
                </div>

                <a href="{{ route('dashboard') }}"
                    class="mt-6 inline-block px-8 py-3 bg-emerald-600 text-white rounded-xl font-bold hover:bg-emerald-700 transition">
                    Kembali ke Dashboard
                </a>
            </div>
        @else
            <!-- Quiz Taker Livewire Component -->
            <livewire:quiz-taker :quizId="$quiz->id" />
        @endif
    </div>
</x-app-layout>