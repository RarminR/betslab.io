<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.tips.index') }}" class="text-slate-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h2 class="font-semibold text-xl text-white">{{ $tip->title }}</h2>
            </div>
            <div class="flex items-center space-x-3">
                @if(!$tip->is_published)
                <form action="{{ route('admin.tips.publish', $tip) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-emerald-500 text-white rounded-lg font-semibold hover:bg-emerald-600 transition">
                        📢 Publică
                    </button>
                </form>
                @else
                <form action="{{ route('admin.tips.unpublish', $tip) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-slate-600 text-white rounded-lg hover:bg-slate-500 transition">
                        Depublică
                    </button>
                </form>
                @endif
                <a href="{{ route('admin.tips.edit', $tip) }}" class="px-4 py-2 bg-amber-400 text-slate-900 rounded-lg font-semibold hover:bg-amber-500 transition">
                    Editează
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-4xl">
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
                        <div class="text-slate-400 text-sm">
                            {{ $tip->is_published ? 'Publicat pe ' . $tip->published_at?->format('d.m.Y H:i') : 'Draft' }}
                            @if($tip->telegram_sent)
                            • ✓ Trimis pe Telegram
                            @endif
                        </div>
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
                    <div class="text-center">
                        <div class="text-slate-400 text-sm">Sport</div>
                        <div class="text-white">{{ $tip->sport }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Send Result to Telegram -->
        @if($tip->is_published && $tip->result !== 'pending')
        <div class="mb-6">
            <form action="{{ route('admin.tips.send-result', $tip) }}" method="POST">
                @csrf
                <button type="submit" class="w-full py-3 bg-blue-500/20 border border-blue-500/30 text-blue-400 rounded-xl hover:bg-blue-500/30 transition">
                    📢 Trimite Rezultatul pe Telegram
                </button>
            </form>
        </div>
        @endif

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
                                <div class="flex items-center text-sm">
                                    <span class="text-slate-400 w-24">Cotă:</span>
                                    <span class="text-white font-semibold">{{ number_format($selection->odds, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Update Result -->
                        <div class="ml-4">
                            <form action="{{ route('admin.selections.update-result', $selection) }}" method="POST" class="flex items-center space-x-2">
                                @csrf
                                @method('PATCH')
                                <select name="result" class="bg-slate-800 border border-slate-700 text-white rounded-lg px-3 py-1 text-sm">
                                    <option value="pending" {{ $selection->result === 'pending' ? 'selected' : '' }}>În așteptare</option>
                                    <option value="won" {{ $selection->result === 'won' ? 'selected' : '' }}>Câștigat</option>
                                    <option value="lost" {{ $selection->result === 'lost' ? 'selected' : '' }}>Pierdut</option>
                                    <option value="void" {{ $selection->result === 'void' ? 'selected' : '' }}>Anulat</option>
                                </select>
                                <button type="submit" class="px-3 py-1 bg-slate-700 text-white rounded-lg text-sm hover:bg-slate-600">
                                    Salvează
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-6 flex items-center justify-between">
            <form action="{{ route('admin.tips.destroy', $tip) }}" method="POST" onsubmit="return confirm('Ești sigur că vrei să ștergi acest pronostic?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-400 hover:text-red-300">
                    Șterge Pronosticul
                </button>
            </form>
            <a href="{{ route('admin.tips.index') }}" class="text-slate-400 hover:text-white">
                Înapoi la listă
            </a>
        </div>
    </div>
</x-admin-layout>

