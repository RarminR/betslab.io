<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Betting Tips') }}
            </h2>
            <div class="flex items-center space-x-4 text-sm">
                <span class="text-slate-400">Our Win Rate:</span>
                <span class="bg-green-500/20 text-green-400 px-3 py-1 rounded-full font-bold">67%</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('error'))
                <div class="bg-red-500/20 border border-red-500/50 text-red-400 px-6 py-4 rounded-xl mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Subscription CTA for non-subscribers -->
            @guest
                <div class="bg-gradient-to-r from-amber-500/20 to-orange-500/20 border border-amber-500/30 rounded-2xl p-8 mb-8 text-center">
                    <h3 class="text-2xl font-bold text-white mb-2">🔒 Unlock Full Analysis</h3>
                    <p class="text-slate-400 mb-6">Subscribe to get full access to all tips with detailed analysis and VIP Telegram channel.</p>
                    <a href="{{ route('register') }}" class="inline-flex items-center space-x-2 bg-gradient-to-r from-amber-500 to-orange-500 text-slate-900 px-6 py-3 rounded-full font-bold hover:from-amber-400 hover:to-orange-400 transition">
                        <span>Start Your Free Trial</span>
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            @endguest

            @auth
                @if(!Auth::user()->hasActiveSubscription())
                    <div class="bg-gradient-to-r from-amber-500/20 to-orange-500/20 border border-amber-500/30 rounded-2xl p-8 mb-8 text-center">
                        <h3 class="text-2xl font-bold text-white mb-2">🔒 Unlock Full Access</h3>
                        <p class="text-slate-400 mb-6">Subscribe to view all tips with full analysis and get access to our VIP Telegram channel.</p>
                        <a href="{{ route('pricing') }}" class="inline-flex items-center space-x-2 bg-gradient-to-r from-amber-500 to-orange-500 text-slate-900 px-6 py-3 rounded-full font-bold hover:from-amber-400 hover:to-orange-400 transition">
                            <span>View Plans</span>
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    </div>
                @endif
            @endauth

            <!-- Tips Grid -->
            @if($tips->count())
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($tips as $tip)
                        <div class="bg-slate-800/50 backdrop-blur rounded-xl border border-slate-700 hover:border-amber-500/30 transition overflow-hidden group">
                            <div class="p-6">
                                <!-- Header -->
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-sm font-medium text-slate-400">{{ $tip->sport }}</span>
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        @if($tip->status === 'won') bg-green-500/20 text-green-400
                                        @elseif($tip->status === 'lost') bg-red-500/20 text-red-400
                                        @elseif($tip->status === 'published') bg-blue-500/20 text-blue-400
                                        @else bg-slate-500/20 text-slate-400 @endif">
                                        {{ ucfirst($tip->status) }}
                                    </span>
                                </div>

                                <!-- Event -->
                                <h3 class="text-lg font-bold text-white mb-2 group-hover:text-amber-400 transition">
                                    {{ $tip->event_name }}
                                </h3>
                                <p class="text-slate-400 text-sm mb-4">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $tip->event_date->format('M d, Y - H:i') }}
                                </p>

                                <!-- Selections -->
                                <div class="space-y-2 mb-4">
                                    @foreach($tip->selections->take(3) as $selection)
                                        <div class="flex items-center justify-between py-2 border-t border-slate-700">
                                            <span class="text-slate-300 text-sm">{{ $selection->selection_name }}</span>
                                            <div class="flex items-center space-x-2">
                                                <span class="text-amber-400 font-semibold">@ {{ number_format($selection->odd, 2) }}</span>
                                                @if($selection->result)
                                                    <span class="w-2 h-2 rounded-full
                                                        @if($selection->result === 'won') bg-green-500
                                                        @elseif($selection->result === 'lost') bg-red-500
                                                        @else bg-yellow-500 @endif">
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                    @if($tip->selections->count() > 3)
                                        <p class="text-slate-500 text-xs">+{{ $tip->selections->count() - 3 }} more selections</p>
                                    @endif
                                </div>

                                <!-- Total Odds -->
                                @php
                                    $totalOdds = $tip->selections->reduce(function($carry, $selection) {
                                        return $carry * $selection->odd;
                                    }, 1);
                                @endphp
                                <div class="flex items-center justify-between pt-4 border-t border-slate-700">
                                    <span class="text-slate-400 text-sm">Total Odds</span>
                                    <span class="text-xl font-bold text-amber-400">@ {{ number_format($totalOdds, 2) }}</span>
                                </div>
                            </div>

                            <!-- View Button -->
                            @auth
                                @if(Auth::user()->hasActiveSubscription())
                                    <a href="{{ route('tips.show', $tip) }}" class="block w-full py-3 bg-slate-700/50 hover:bg-amber-500 text-center text-slate-300 hover:text-slate-900 font-semibold transition">
                                        View Full Analysis →
                                    </a>
                                @else
                                    <div class="block w-full py-3 bg-slate-700/50 text-center text-slate-500">
                                        🔒 Subscribe to view
                                    </div>
                                @endif
                            @else
                                <a href="{{ route('register') }}" class="block w-full py-3 bg-slate-700/50 hover:bg-amber-500 text-center text-slate-300 hover:text-slate-900 font-semibold transition">
                                    Sign up to view →
                                </a>
                            @endauth
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $tips->links() }}
                </div>
            @else
                <div class="bg-slate-800/50 backdrop-blur rounded-xl border border-slate-700 p-12 text-center">
                    <svg class="w-16 h-16 text-slate-600 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <h3 class="text-xl font-bold text-white mb-2">No Tips Available Yet</h3>
                    <p class="text-slate-400 mb-6">Our analysts are working on the next tips. Check back soon!</p>
                    <a href="{{ route('pricing') }}" class="inline-flex items-center space-x-2 text-amber-400 hover:text-amber-300 font-semibold">
                        <span>Subscribe to get notified</span>
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
