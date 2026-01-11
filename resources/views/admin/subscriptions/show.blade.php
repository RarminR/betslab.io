<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.subscriptions.index') }}" class="text-slate-400 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-white">Abonament #{{ $subscription->id }}</h2>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <div class="bg-slate-800/50 rounded-xl border border-slate-700 p-6 mb-6">
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <div class="text-slate-400 text-sm">Utilizator</div>
                    <a href="{{ route('admin.users.show', $subscription->user) }}" class="text-white font-medium hover:text-amber-400">
                        {{ $subscription->user->name }}
                    </a>
                    <div class="text-slate-400 text-sm">{{ $subscription->user->email }}</div>
                </div>
                <div>
                    <div class="text-slate-400 text-sm">Plan</div>
                    <div class="text-white font-medium">{{ $subscription->plan->name }}</div>
                </div>
                <div>
                    <div class="text-slate-400 text-sm">Preț</div>
                    <div class="text-white font-medium">{{ number_format($subscription->price, 2) }} RON</div>
                </div>
                <div>
                    <div class="text-slate-400 text-sm">Status</div>
                    <span class="px-2 py-1 rounded text-xs font-semibold
                        @if($subscription->status === 'active') bg-emerald-500/20 text-emerald-400
                        @elseif($subscription->status === 'expired') bg-slate-500/20 text-slate-400
                        @else bg-amber-500/20 text-amber-400
                        @endif">
                        {{ ucfirst($subscription->status) }}
                    </span>
                </div>
                <div>
                    <div class="text-slate-400 text-sm">Început</div>
                    <div class="text-white">{{ $subscription->starts_at?->format('d.m.Y') ?? '-' }}</div>
                </div>
                <div>
                    <div class="text-slate-400 text-sm">Expiră</div>
                    <div class="text-white">{{ $subscription->ends_at?->format('d.m.Y') ?? 'Lifetime' }}</div>
                </div>
            </div>

            <div class="mt-6 pt-6 border-t border-slate-700 flex items-center space-x-3">
                @if($subscription->status === 'pending')
                <form action="{{ route('admin.subscriptions.activate', $subscription) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition">
                        Activează
                    </button>
                </form>
                @elseif($subscription->status === 'active')
                <form action="{{ route('admin.subscriptions.expire', $subscription) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-amber-400 text-slate-900 rounded-lg hover:bg-amber-500 transition">
                        Marchează Expirat
                    </button>
                </form>
                <form action="{{ route('admin.subscriptions.cancel', $subscription) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-500/20 text-red-400 border border-red-500/30 rounded-lg hover:bg-red-500/30 transition">
                        Anulează
                    </button>
                </form>
                @endif
            </div>
        </div>

        <!-- Payments -->
        <div class="bg-slate-800/50 rounded-xl border border-slate-700">
            <div class="p-4 border-b border-slate-700">
                <h3 class="font-semibold text-white">Plăți Asociate</h3>
            </div>
            <div class="divide-y divide-slate-700">
                @forelse($subscription->payments as $payment)
                <div class="p-4 flex items-center justify-between">
                    <div>
                        <div class="text-white font-medium">{{ $payment->transaction_id }}</div>
                        <div class="text-slate-400 text-sm">{{ ucfirst($payment->gateway) }} • {{ $payment->created_at->format('d.m.Y H:i') }}</div>
                    </div>
                    <div class="text-right">
                        <span class="px-2 py-1 rounded text-xs font-semibold
                            @if($payment->status === 'completed') bg-emerald-500/20 text-emerald-400
                            @elseif($payment->status === 'failed') bg-red-500/20 text-red-400
                            @else bg-amber-500/20 text-amber-400
                            @endif">
                            {{ ucfirst($payment->status) }}
                        </span>
                        <div class="text-white font-semibold mt-1">{{ $payment->formatted_amount }}</div>
                    </div>
                </div>
                @empty
                <div class="p-4 text-slate-400 text-center">Nicio plată asociată</div>
                @endforelse
            </div>
        </div>
    </div>
</x-admin-layout>

