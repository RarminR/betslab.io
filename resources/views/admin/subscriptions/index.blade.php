<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-white">Abonamente</h2>
            <a href="{{ route('admin.subscriptions.create') }}" class="px-4 py-2 bg-amber-400 text-slate-900 rounded-lg font-semibold hover:bg-amber-500 transition">
                + Abonament Manual
            </a>
        </div>
    </x-slot>

    <!-- Filters -->
    <div class="mb-6 flex items-center space-x-4">
        <form method="GET" class="flex items-center space-x-4">
            <select name="status" onchange="this.form.submit()" class="bg-slate-800 border border-slate-700 text-white rounded-lg px-4 py-2">
                <option value="all" {{ request('status') === 'all' ? 'selected' : '' }}>Toate statusurile</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>Expirate</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>În așteptare</option>
                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Anulate</option>
            </select>
            <select name="plan_id" onchange="this.form.submit()" class="bg-slate-800 border border-slate-700 text-white rounded-lg px-4 py-2">
                <option value="">Toate planurile</option>
                @foreach($plans as $plan)
                <option value="{{ $plan->id }}" {{ request('plan_id') == $plan->id ? 'selected' : '' }}>{{ $plan->name }}</option>
                @endforeach
            </select>
        </form>
    </div>

    <!-- Subscriptions Table -->
    <div class="bg-slate-800/50 rounded-xl border border-slate-700 overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-800">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-400 uppercase">Utilizator</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-400 uppercase">Plan</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-400 uppercase">Preț</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-400 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-400 uppercase">Perioadă</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-slate-400 uppercase">Acțiuni</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700">
                @forelse($subscriptions as $subscription)
                <tr class="hover:bg-slate-800/50">
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.users.show', $subscription->user) }}" class="text-white font-medium hover:text-amber-400">
                            {{ $subscription->user->name }}
                        </a>
                        <div class="text-slate-400 text-sm">{{ $subscription->user->email }}</div>
                    </td>
                    <td class="px-6 py-4 text-slate-300">{{ $subscription->plan->name }}</td>
                    <td class="px-6 py-4 text-white font-semibold">{{ number_format($subscription->price, 2) }} RON</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded text-xs font-semibold
                            @if($subscription->status === 'active') bg-emerald-500/20 text-emerald-400
                            @elseif($subscription->status === 'expired') bg-slate-500/20 text-slate-400
                            @elseif($subscription->status === 'cancelled') bg-red-500/20 text-red-400
                            @else bg-amber-500/20 text-amber-400
                            @endif">
                            {{ ucfirst($subscription->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-slate-400 text-sm">
                        @if($subscription->starts_at)
                        {{ $subscription->starts_at->format('d.m.Y') }} -
                        {{ $subscription->ends_at?->format('d.m.Y') ?? 'Lifetime' }}
                        @else
                        -
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end space-x-2">
                            @if($subscription->status === 'pending')
                            <form action="{{ route('admin.subscriptions.activate', $subscription) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-emerald-400 hover:text-emerald-300 text-sm">Activează</button>
                            </form>
                            @elseif($subscription->status === 'active')
                            <form action="{{ route('admin.subscriptions.expire', $subscription) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-amber-400 hover:text-amber-300 text-sm">Expiră</button>
                            </form>
                            @endif
                            <a href="{{ route('admin.subscriptions.show', $subscription) }}" class="text-slate-400 hover:text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-slate-400">
                        Niciun abonament găsit.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $subscriptions->links() }}
    </div>
</x-admin-layout>

