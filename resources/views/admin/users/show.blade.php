<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.users.index') }}" class="text-slate-400 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-white">{{ $user->name }}</h2>
        </div>
    </x-slot>

    <div class="grid md:grid-cols-3 gap-6">
        <!-- User Info -->
        <div class="md:col-span-1">
            <div class="bg-slate-800/50 rounded-xl border border-slate-700 p-6">
                <div class="text-center mb-6">
                    <div class="w-20 h-20 mx-auto rounded-full bg-amber-400/20 flex items-center justify-center mb-4">
                        <span class="text-3xl text-amber-400 font-bold">{{ substr($user->name, 0, 1) }}</span>
                    </div>
                    <h3 class="text-xl font-semibold text-white">{{ $user->name }}</h3>
                    <p class="text-slate-400">{{ $user->email }}</p>
                </div>

                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="text-slate-400">Rol</span>
                        <span class="@if($user->is_admin) text-red-400 @else text-white @endif font-medium">
                            {{ $user->is_admin ? 'Admin' : 'User' }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">Telegram</span>
                        <span class="text-white">{{ $user->telegram_username ?: '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">Înregistrat</span>
                        <span class="text-white">{{ $user->created_at->format('d.m.Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">Email verificat</span>
                        <span class="@if($user->email_verified_at) text-emerald-400 @else text-red-400 @endif">
                            {{ $user->email_verified_at ? '✓' : '✗' }}
                        </span>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-slate-700 space-y-3">
                    <form action="{{ route('admin.users.toggle-admin', $user) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full py-2 @if($user->is_admin) bg-slate-700 text-white @else bg-red-500/20 text-red-400 @endif rounded-lg text-sm hover:opacity-80 transition">
                            {{ $user->is_admin ? 'Revocă Admin' : 'Promovează Admin' }}
                        </button>
                    </form>
                    @if(!$user->is_admin)
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Ești sigur?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full py-2 bg-red-500/10 text-red-400 border border-red-500/30 rounded-lg text-sm hover:bg-red-500/20 transition">
                            Șterge Utilizatorul
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>

        <!-- Subscriptions & Payments -->
        <div class="md:col-span-2 space-y-6">
            <!-- Active Subscription -->
            @if($user->activeSubscription)
            <div class="bg-emerald-500/10 border border-emerald-500/30 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-white mb-4">Abonament Activ</h3>
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <div class="text-slate-400 text-sm">Plan</div>
                        <div class="text-white font-medium">{{ $user->activeSubscription->plan->name }}</div>
                    </div>
                    <div>
                        <div class="text-slate-400 text-sm">Început</div>
                        <div class="text-white">{{ $user->activeSubscription->starts_at?->format('d.m.Y') }}</div>
                    </div>
                    <div>
                        <div class="text-slate-400 text-sm">Expiră</div>
                        <div class="text-white">{{ $user->activeSubscription->ends_at?->format('d.m.Y') ?? 'Lifetime' }}</div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Subscription History -->
            <div class="bg-slate-800/50 rounded-xl border border-slate-700">
                <div class="p-4 border-b border-slate-700">
                    <h3 class="font-semibold text-white">Istoric Abonamente</h3>
                </div>
                <div class="divide-y divide-slate-700">
                    @forelse($user->subscriptions as $subscription)
                    <div class="p-4 flex items-center justify-between">
                        <div>
                            <div class="text-white font-medium">{{ $subscription->plan->name }}</div>
                            <div class="text-slate-400 text-sm">{{ $subscription->created_at->format('d.m.Y') }}</div>
                        </div>
                        <div class="text-right">
                            <span class="px-2 py-1 rounded text-xs font-semibold
                                @if($subscription->status === 'active') bg-emerald-500/20 text-emerald-400
                                @elseif($subscription->status === 'expired') bg-slate-500/20 text-slate-400
                                @else bg-amber-500/20 text-amber-400
                                @endif">
                                {{ ucfirst($subscription->status) }}
                            </span>
                            <div class="text-white font-semibold mt-1">{{ number_format($subscription->price, 2) }} RON</div>
                        </div>
                    </div>
                    @empty
                    <div class="p-4 text-slate-400 text-center">Niciun abonament</div>
                    @endforelse
                </div>
            </div>

            <!-- Payment History -->
            <div class="bg-slate-800/50 rounded-xl border border-slate-700">
                <div class="p-4 border-b border-slate-700">
                    <h3 class="font-semibold text-white">Istoric Plăți</h3>
                </div>
                <div class="divide-y divide-slate-700">
                    @forelse($user->payments as $payment)
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
                    <div class="p-4 text-slate-400 text-center">Nicio plată</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

