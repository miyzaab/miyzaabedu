<div class="max-w-3xl mx-auto p-4" wire:poll.1s>
    @if(!$isFinished)
        @if($this->currentQuestion)
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden p-6">

                <!-- Timer Display -->
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-2">
                        <div
                            class="w-3 h-3 rounded-full animate-pulse {{ $this->remainingTime <= 60 ? 'bg-red-500' : 'bg-emerald-500' }}">
                        </div>
                        <span class="text-sm font-medium text-gray-600">Waktu Tersisa</span>
                    </div>
                    <div
                        class="px-4 py-2 rounded-xl font-mono text-xl font-bold {{ $this->remainingTime <= 60 ? 'bg-red-100 text-red-600' : 'bg-emerald-100 text-emerald-600' }}">
                        {{ sprintf('%02d:%02d', floor($this->remainingTime / 60), $this->remainingTime % 60) }}
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="w-full bg-gray-200 rounded-full h-2.5 mb-6">
                    <div class="bg-emerald-600 h-2.5 rounded-full transition-all duration-300"
                        style="width: {{ (($currentQuestionIndex + 1) / $this->questions->count()) * 100 }}%"></div>
                </div>

                <div class="mb-6">
                    <span class="text-emerald-600 font-semibold text-sm tracking-wide">
                        PERTANYAAN {{ $currentQuestionIndex + 1 }} DARI {{ $this->questions->count() }}
                    </span>
                    <h2 class="text-xl font-bold text-gray-800 mt-2">{{ $this->currentQuestion->text }}</h2>
                </div>

                <div class="space-y-3">
                    @foreach($this->currentQuestion->options as $key => $value)
                        <div wire:click="selectAnswer({{ $this->currentQuestion->id }}, {{ $key }})" class="p-4 rounded-xl border-2 flex items-center cursor-pointer transition-all
                                                                @if(isset($userAnswers[$this->currentQuestion->id]) && $userAnswers[$this->currentQuestion->id] == $key)
                                                                    border-emerald-600 bg-emerald-50 shadow-md
                                                                @else
                                                                    border-gray-200 bg-white hover:bg-gray-50 hover:border-emerald-300
                                                                @endif">
                            <div class="w-8 h-8 rounded-full border-2 flex items-center justify-center mr-4 font-bold
                                                                @if(isset($userAnswers[$this->currentQuestion->id]) && $userAnswers[$this->currentQuestion->id] == $key)
                                                                    border-emerald-600 text-emerald-600 bg-white
                                                                @else
                                                                    border-gray-400 text-gray-500
                                                                @endif">
                                {{ chr(65 + $key) }}
                            </div>
                            <span class="text-gray-800 font-medium">{{ $value }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-between mt-8 pt-6 border-t border-gray-100">
                    @if($currentQuestionIndex > 0)
                        <button type="button" wire:click="prevQuestion"
                            class="px-6 py-2 rounded-lg text-gray-500 hover:text-gray-700 font-medium transition">
                            ← Sebelumnya
                        </button>
                    @else
                        <div></div>
                    @endif

                    @if($currentQuestionIndex === $this->questions->count() - 1)
                        <button type="button" wire:click="submit"
                            class="px-8 py-3 bg-emerald-600 text-white rounded-xl shadow-lg hover:bg-emerald-700 font-bold transition">
                            Selesai & Submit
                        </button>
                    @else
                        <button type="button" wire:click="nextQuestion"
                            class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-bold transition">
                            Selanjutnya →
                        </button>
                    @endif
                </div>
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-xl p-8 text-center">
                <p class="text-gray-500">Tidak ada pertanyaan untuk kuis ini.</p>
                <a href="{{ route('quiz.index') }}" class="mt-4 inline-block text-emerald-600 hover:underline">Kembali</a>
            </div>
        @endif
    @else
        <!-- Result Cards -->
        <div class="text-center bg-white rounded-3xl p-12 shadow-2xl relative overflow-hidden">
            @if($passed)
                <div class="absolute inset-0 bg-green-500/10 z-0"></div>
                <div class="relative z-10">
                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Barakallahu Fiikum!</h2>
                    <p class="text-gray-600 mb-4">Selamat, antum telah lulus kuis ini.</p>

                    <div class="text-5xl font-black text-green-600 mb-4">{{ $score }}<span
                            class="text-xl text-gray-400">/100</span></div>

                    <div class="text-sm text-gray-500 mb-6">
                        Waktu: {{ floor($timeTaken / 60) }}m {{ $timeTaken % 60 }}s
                    </div>

                    <a href="{{ route('dashboard') }}"
                        class="inline-block px-8 py-3 bg-green-600 text-white rounded-xl font-bold shadow-lg hover:bg-green-700 transition">
                        Kembali ke Dashboard
                    </a>
                </div>
            @else
                <div class="absolute inset-0 bg-red-500/10 z-0"></div>
                <div class="relative z-10">
                    <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Afwan, Belum Lulus</h2>
                    <p class="text-gray-600 mb-4">Nilai minimum: 60</p>

                    <div class="text-5xl font-black text-red-500 mb-4">{{ $score }}<span
                            class="text-xl text-gray-400">/100</span></div>

                    <div class="text-sm text-gray-500 mb-4">
                        Waktu: {{ floor($timeTaken / 60) }}m {{ $timeTaken % 60 }}s
                    </div>

                    <div class="bg-amber-50 border border-amber-200 rounded-xl p-3 text-amber-700 text-xs mb-6">
                        ⚠️ Kuis hanya bisa dikerjakan satu kali.
                    </div>

                    <a href="{{ route('dashboard') }}"
                        class="inline-block px-8 py-3 bg-gray-600 text-white rounded-xl font-bold shadow-lg hover:bg-gray-700 transition">
                        Kembali ke Dashboard
                    </a>
                </div>
            @endif
        </div>
    @endif
</div>