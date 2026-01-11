<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Abonamentul Meu
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Current Subscription -->
            @if($activeSubscription)
            <div class="bg-slate-800/50 rounded-2xl border border-slate-700 p-6 mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-white">Abonament Activ</h3>
                    <span class="px-3 py-1 bg-emerald-500/20 text-emerald-400 rounded-full text-sm font-semibold">
                        Activ
                    </span>
                </div>

                <div class="grid md:grid-cols-3 gap-6">
                    <div>
                        <div class="text-slate-400 text-sm mb-1">Plan</div>
                        <div class="text-white font-semibold">{{ $activeSubscription->plan->name }}</div>
                    </div>
                    <div>
                        <div class="text-slate-400 text-sm mb-1">Început</div>
                        <div class="text-white font-semibold">{{ $activeSubscription->starts_at?->format('d.m.Y') }}</div>
                    </div>
                    <div>
                        <div class="text-slate-400 text-sm mb-1">Expiră</div>
                        @if($activeSubscription->ends_at)
                        <div class="text-white font-semibold">
                            {{ $activeSubscription->ends_at->format('d.m.Y') }}
                            <span class="text-slate-400 text-sm">({{ $activeSubscription->days_remaining }} zile)</span>
                        </div>
                        @else
                        <div class="text-emerald-400 font-semibold">Lifetime - fără expirare</div>
                        @endif
                    </div>
                </div>

                @if($activeSubscription->ends_at && !$activeSubscription->plan->is_lifetime)
                <div class="mt-6 pt-6 border-t border-slate-700 flex justify-between items-center">
                    <p class="text-slate-400 text-sm">Vrei să anulezi abonamentul?</p>
                    <form action="{{ route('subscription.cancel', $activeSubscription) }}" method="POST" onsubmit="return confirm('Ești sigur că vrei să anulezi abonamentul?')">
                        @csrf
                        <button type="submit" class="text-red-400 hover:text-red-300 text-sm font-medium">
                            Anulează Abonamentul
                        </button>
                    </form>
                </div>
                @endif
            </div>
            @else
            <div class="bg-amber-500/10 border border-amber-500/30 rounded-2xl p-6 mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-2">Nu ai un abonament activ</h3>
                        <p class="text-slate-400">Abonează-te pentru a avea acces la toate pronosticurile.</p>
                    </div>
                    <a href="{{ route('pricing') }}" class="mt-4 md:mt-0 inline-flex items-center px-6 py-3 bg-gradient-to-r from-amber-400 to-orange-500 text-slate-900 rounded-lg font-semibold hover:from-amber-500 hover:to-orange-600 transition">
                        Vezi Planuri
                    </a>
                </div>
            </div>
            @endif

            <!-- Subscription History -->
            <div class="bg-slate-800/50 rounded-2xl border border-slate-700">
                <div class="p-6 border-b border-slate-700">
                    <h3 class="text-lg font-semibold text-white">Istoric Abonamente</h3>
                </div>

                @if($subscriptionHistory->count() > 0)
                <div class="divide-y divide-slate-700">
                    @foreach($subscriptionHistory as $subscription)
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="font-medium text-white">{{ $subscription->plan->name }}</div>
                                <div class="text-slate-400 text-sm">
                                    {{ $subscription->created_at->format('d.m.Y') }}
                                    @if($subscription->starts_at && $subscription->ends_at)
                                    • {{ $subscription->starts_at->format('d.m.Y') }} - {{ $subscription->ends_at->format('d.m.Y') }}
                                    @elseif($subscription->starts_at && !$subscription->ends_at)
                                    • Lifetime
                                    @endif
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    @if($subscription->status === 'active') bg-emerald-500/20 text-emerald-400
                                    @elseif($subscription->status === 'expired') bg-slate-500/20 text-slate-400
                                    @elseif($subscription->status === 'cancelled') bg-red-500/20 text-red-400
                                    @else bg-amber-500/20 text-amber-400
                                    @endif">
                                    {{ ucfirst($subscription->status) }}
                                </span>
                                <div class="text-white font-semibold mt-1">{{ number_format($subscription->price, 2) }} RON</div>
                            </div>
                        </div>

                        @if($subscription->payments->count() > 0)
                        <div class="mt-4 pt-4 border-t border-slate-700/50">
                            <div class="text-slate-400 text-sm mb-2">Plăți:</div>
                            @foreach($subscription->payments as $payment)
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate-400">
                                    {{ $payment->created_at->format('d.m.Y H:i') }} • {{ ucfirst($payment->gateway) }}
                                </span>
                                <span class="@if($payment->status === 'completed') text-emerald-400 @else text-amber-400 @endif">
                                    {{ $payment->formatted_amount }} - {{ ucfirst($payment->status) }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
                @else
                <div class="p-6 text-center text-slate-400">
                    Nu ai încă niciun abonament.
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

