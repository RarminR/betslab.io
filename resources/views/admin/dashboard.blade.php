<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">Dashboard Admin</h2>
    </x-slot>

    <!-- Stats Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-slate-800/50 rounded-xl border border-slate-700 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-slate-400 text-sm">Utilizatori</div>
                    <div class="text-2xl font-bold text-white">{{ $stats['total_users'] }}</div>
                </div>
                <div class="w-12 h-12 rounded-lg bg-blue-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-slate-800/50 rounded-xl border border-slate-700 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-slate-400 text-sm">Abonați Activi</div>
                    <div class="text-2xl font-bold text-emerald-400">{{ $stats['active_subscribers'] }}</div>
                </div>
                <div class="w-12 h-12 rounded-lg bg-emerald-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-slate-800/50 rounded-xl border border-slate-700 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-slate-400 text-sm">Venit Total</div>
                    <div class="text-2xl font-bold text-amber-400">{{ number_format($stats['total_revenue'], 0) }} RON</div>
                </div>
                <div class="w-12 h-12 rounded-lg bg-amber-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-slate-800/50 rounded-xl border border-slate-700 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-slate-400 text-sm">Win Rate</div>
                    <div class="text-2xl font-bold text-white">{{ $stats['win_rate'] }}%</div>
                </div>
                <div class="w-12 h-12 rounded-lg bg-purple-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Tips Stats -->
    <div class="grid grid-cols-4 gap-4 mb-8">
        <div class="bg-slate-800/50 rounded-xl border border-slate-700 p-4 text-center">
            <div class="text-2xl font-bold text-white">{{ $stats['total_tips'] }}</div>
            <div class="text-slate-400 text-sm">Total Tips</div>
        </div>
        <div class="bg-slate-800/50 rounded-xl border border-slate-700 p-4 text-center">
            <div class="text-2xl font-bold text-amber-400">{{ $stats['pending_tips'] }}</div>
            <div class="text-slate-400 text-sm">În Așteptare</div>
        </div>
        <div class="bg-slate-800/50 rounded-xl border border-slate-700 p-4 text-center">
            <div class="text-2xl font-bold text-emerald-400">{{ $stats['won_tips'] }}</div>
            <div class="text-slate-400 text-sm">Câștigate</div>
        </div>
        <div class="bg-slate-800/50 rounded-xl border border-slate-700 p-4 text-center">
            <div class="text-2xl font-bold text-red-400">{{ $stats['lost_tips'] }}</div>
            <div class="text-slate-400 text-sm">Pierdute</div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid md:grid-cols-2 gap-6">
        <!-- Recent Subscriptions -->
        <div class="bg-slate-800/50 rounded-xl border border-slate-700">
            <div class="p-4 border-b border-slate-700 flex items-center justify-between">
                <h3 class="font-semibold text-white">Abonamente Recente</h3>
                <a href="{{ route('admin.subscriptions.index') }}" class="text-amber-400 text-sm hover:text-amber-300">Vezi toate</a>
            </div>
            <div class="divide-y divide-slate-700">
                @forelse($recentSubscriptions as $subscription)
                <div class="p-4 flex items-center justify-between">
                    <div>
                        <div class="text-white font-medium">{{ $subscription->user->name }}</div>
                        <div class="text-slate-400 text-sm">{{ $subscription->plan->name }}</div>
                    </div>
                    <span class="px-2 py-1 rounded text-xs font-semibold
                        @if($subscription->status === 'active') bg-emerald-500/20 text-emerald-400
                        @else bg-slate-500/20 text-slate-400
                        @endif">
                        {{ ucfirst($subscription->status) }}
                    </span>
                </div>
                @empty
                <div class="p-4 text-slate-400 text-center">Niciun abonament</div>
                @endforelse
            </div>
        </div>

        <!-- Recent Tips -->
        <div class="bg-slate-800/50 rounded-xl border border-slate-700">
            <div class="p-4 border-b border-slate-700 flex items-center justify-between">
                <h3 class="font-semibold text-white">Pronosticuri Recente</h3>
                <a href="{{ route('admin.tips.index') }}" class="text-amber-400 text-sm hover:text-amber-300">Vezi toate</a>
            </div>
            <div class="divide-y divide-slate-700">
                @forelse($recentTips as $tip)
                <div class="p-4 flex items-center justify-between">
                    <div>
                        <div class="text-white font-medium">{{ $tip->title }}</div>
                        <div class="text-slate-400 text-sm">{{ $tip->sport }} • Cotă: {{ $tip->total_odds }}</div>
                    </div>
                    <span class="px-2 py-1 rounded text-xs font-semibold
                        @if($tip->result === 'won') bg-emerald-500/20 text-emerald-400
                        @elseif($tip->result === 'lost') bg-red-500/20 text-red-400
                        @else bg-amber-500/20 text-amber-400
                        @endif">
                        {{ $tip->is_published ? 'Publicat' : 'Draft' }}
                    </span>
                </div>
                @empty
                <div class="p-4 text-slate-400 text-center">Niciun pronostic</div>
                @endforelse
            </div>
        </div>
    </div>
</x-admin-layout>

