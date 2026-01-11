<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-white">Pronosticuri</h2>
            <a href="{{ route('admin.tips.create') }}" class="px-4 py-2 bg-amber-400 text-slate-900 rounded-lg font-semibold hover:bg-amber-500 transition">
                + Adaugă Pronostic
            </a>
        </div>
    </x-slot>

    <!-- Filters -->
    <div class="mb-6 flex items-center space-x-4">
        <form method="GET" class="flex items-center space-x-4">
            <select name="status" onchange="this.form.submit()" class="bg-slate-800 border border-slate-700 text-white rounded-lg px-4 py-2">
                <option value="all" {{ request('status') === 'all' ? 'selected' : '' }}>Toate statusurile</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>În așteptare</option>
                <option value="won" {{ request('status') === 'won' ? 'selected' : '' }}>Câștigate</option>
                <option value="lost" {{ request('status') === 'lost' ? 'selected' : '' }}>Pierdute</option>
            </select>
            <select name="published" onchange="this.form.submit()" class="bg-slate-800 border border-slate-700 text-white rounded-lg px-4 py-2">
                <option value="">Toate</option>
                <option value="yes" {{ request('published') === 'yes' ? 'selected' : '' }}>Publicate</option>
                <option value="no" {{ request('published') === 'no' ? 'selected' : '' }}>Draft</option>
            </select>
        </form>
    </div>

    <!-- Tips Table -->
    <div class="bg-slate-800/50 rounded-xl border border-slate-700 overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-800">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-400 uppercase">Titlu</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-400 uppercase">Canal</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-400 uppercase">Sport</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-400 uppercase">Cotă</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-400 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-400 uppercase">Publicat</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-400 uppercase">Data</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-slate-400 uppercase">Acțiuni</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700">
                @forelse($tips as $tip)
                <tr class="hover:bg-slate-800/50">
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.tips.show', $tip) }}" class="text-white font-medium hover:text-amber-400">
                            {{ $tip->title }}
                        </a>
                        <div class="text-slate-400 text-sm">{{ $tip->selections->count() }} selecții</div>
                    </td>
                    <td class="px-6 py-4">
                        @if($tip->isVip())
                            <span class="px-2 py-1 rounded text-xs font-semibold bg-amber-500/20 text-amber-400">VIP</span>
                        @else
                            <span class="px-2 py-1 rounded text-xs font-semibold bg-emerald-500/20 text-emerald-400">FREE</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-slate-300">{{ $tip->sport }}</td>
                    <td class="px-6 py-4 text-white font-semibold">{{ number_format($tip->total_odds, 2) }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded text-xs font-semibold
                            @if($tip->result === 'won') bg-emerald-500/20 text-emerald-400
                            @elseif($tip->result === 'lost') bg-red-500/20 text-red-400
                            @else bg-amber-500/20 text-amber-400
                            @endif">
                            {{ ucfirst($tip->result) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        @if($tip->is_published)
                        <span class="text-emerald-400">✓</span>
                        @else
                        <span class="text-slate-500">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-slate-400 text-sm">{{ $tip->created_at->format('d.m.Y') }}</td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end space-x-2">
                            <a href="{{ route('admin.tips.edit', $tip) }}" class="text-slate-400 hover:text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            <form action="{{ route('admin.tips.destroy', $tip) }}" method="POST" onsubmit="return confirm('Ești sigur?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-8 text-center text-slate-400">
                        Niciun pronostic găsit.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $tips->links() }}
    </div>
</x-admin-layout>

