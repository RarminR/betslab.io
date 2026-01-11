<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('tips.index') }}" class="text-slate-400 hover:text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ $tip->title }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Status Card -->
            <div class="mb-6 p-6 rounded-2xl
                @if($tip->result === 'won') bg-emerald-500/10 border border-emerald-500/30
                @elseif($tip->result === 'lost') bg-red-500/10 border border-red-500/30
                @else bg-amber-500/10 border border-amber-500/30
                @endif">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="flex items-center space-x-4">
                        <span class="w-12 h-12 rounded-full flex items-center justify-center text-2xl
                            @if($tip->result === 'won') bg-emerald-500/20
                            @elseif($tip->result === 'lost') bg-red-500/20
                            @else bg-amber-500/20
                            @endif">
                            @if($tip->result === 'won') ✓
                            @elseif($tip->result === 'lost') ✗
                            @else ⏳
                            @endif
                        </span>
                        <div>
                            <div class="text-lg font-semibold
                                @if($tip->result === 'won') text-emerald-400
                                @elseif($tip->result === 'lost') text-red-400
                                @else text-amber-400
                                @endif">
                                @if($tip->result === 'won') Câștigat
                                @elseif($tip->result === 'lost') Pierdut
                                @else În Așteptare
                                @endif
                            </div>
                            <div class="text-slate-400 text-sm">{{ $tip->published_at?->format('d.m.Y H:i') }}</div>
                        </div>
                    </div>
                    <div class="mt-4 md:mt-0 flex items-center space-x-6">
                        <div class="text-center">
                            <div class="text-slate-400 text-sm">Cotă Totală</div>
                            <div class="text-2xl font-bold text-white">{{ number_format($tip->total_odds, 2) }}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-slate-400 text-sm">Miză</div>
                            <div class="text-xl text-amber-400">{{ str_repeat('⭐', $tip->stake) }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Selections -->
            <div class="bg-slate-800/50 rounded-2xl border border-slate-700 overflow-hidden">
                <div class="p-6 border-b border-slate-700">
                    <h3 class="text-lg font-semibold text-white">Selecții</h3>
                </div>

                <div class="divide-y divide-slate-700">
                    @foreach($tip->selections as $selection)
                    <div class="p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-2">
                                    <span class="w-8 h-8 rounded-full flex items-center justify-center text-sm
                                        @if($selection->result === 'won') bg-emerald-500/20 text-emerald-400
                                        @elseif($selection->result === 'lost') bg-red-500/20 text-red-400
                                        @else bg-slate-700 text-slate-400
                                        @endif">
                                        @if($selection->result === 'won') ✓
                                        @elseif($selection->result === 'lost') ✗
                                        @else ○
                                        @endif
                                    </span>
                                    <div>
                                        <div class="font-medium text-white">{{ $selection->event_name }}</div>
                                        @if($selection->league)
                                        <div class="text-slate-400 text-sm">{{ $selection->league }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="ml-11 space-y-2">
                                    <div class="flex items-center text-sm">
                                        <span class="text-slate-400 w-24">Data:</span>
                                        <span class="text-white">{{ $selection->event_date->format('d.m.Y H:i') }}</span>
                                    </div>
                                    <div class="flex items-center text-sm">
                                        <span class="text-slate-400 w-24">Pronostic:</span>
                                        <span class="text-amber-400 font-medium">{{ $selection->prediction }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <div class="text-slate-400 text-sm">Cotă</div>
                                <div class="text-xl font-bold text-white">{{ number_format($selection->odds, 2) }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Back Button -->
            <div class="mt-6 text-center">
                <a href="{{ route('tips.index') }}" class="inline-flex items-center text-slate-400 hover:text-white transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Înapoi la pronosticuri
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

