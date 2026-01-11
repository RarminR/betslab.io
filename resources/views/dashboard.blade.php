<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Welcome Section -->
            <div class="bg-slate-800/50 backdrop-blur rounded-2xl border border-slate-700 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-white">Welcome back, {{ $user->name }}! 👋</h3>
                        <p class="text-slate-400 mt-1">Here's what's happening with your account</p>
                    </div>
                    @if($activeSubscription)
                        <span class="inline-flex items-center px-4 py-2 bg-green-500/20 text-green-400 rounded-full font-semibold">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                            Active Member
                        </span>
                    @else
                        <span class="inline-flex items-center px-4 py-2 bg-red-500/20 text-red-400 rounded-full font-semibold">
                            No Active Subscription
                        </span>
                    @endif
                </div>
            </div>

            <!-- Subscription Status -->
            @if($activeSubscription)
                <div class="bg-gradient-to-br from-amber-500/20 to-orange-500/20 rounded-2xl border border-amber-500/30 p-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h4 class="text-lg font-semibold text-white">Your Current Plan</h4>
                            <p class="text-3xl font-bold text-amber-400 mt-1">{{ $activeSubscription->plan->name }}</p>
                            <div class="flex items-center gap-4 mt-2 text-slate-400 text-sm">
                                <span>Started: {{ $activeSubscription->starts_at->format('M d, Y') }}</span>
                                @if($activeSubscription->ends_at)
                                    <span>•</span>
                                    <span>
                                        @if($activeSubscription->plan->is_lifetime)
                                            Never expires
                                        @else
                                            Expires: {{ $activeSubscription->ends_at->format('M d, Y') }}
                                        @endif
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-3">
                            <a href="{{ route('telegram.access') }}" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-400 hover:to-blue-500 text-white rounded-xl font-semibold transition transform hover:scale-105">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                                </svg>
                                Join Telegram Channel
                            </a>
                            <a href="{{ route('tips.index') }}" class="inline-flex items-center justify-center px-6 py-3 bg-slate-700 hover:bg-slate-600 text-white rounded-xl font-semibold transition">
                                View All Tips
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <!-- No Subscription - Two Column Layout -->
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Free Telegram Channel -->
                    <div class="bg-gradient-to-br from-emerald-500/20 to-green-500/20 rounded-2xl border border-emerald-500/30 p-6">
                        <div class="flex items-start space-x-4">
                            <div class="w-14 h-14 bg-emerald-500/30 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-8 h-8 text-emerald-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <span class="inline-block px-2 py-0.5 bg-emerald-500/30 text-emerald-400 text-xs font-semibold rounded-full mb-2">FREE</span>
                                <h4 class="text-xl font-bold text-white mb-2">Join Our Free Community</h4>
                                <p class="text-slate-400 text-sm mb-4">Get free tips, community discussions, and betting education.</p>
                                <a href="{{ route('telegram.free') }}" class="inline-flex items-center space-x-2 bg-emerald-500 hover:bg-emerald-400 text-white px-4 py-2 rounded-lg font-semibold text-sm transition">
                                    <span>Join Free Channel</span>
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Premium CTA -->
                    <div class="bg-gradient-to-br from-amber-500/20 to-orange-500/20 rounded-2xl border border-amber-500/30 p-6">
                        <div class="flex items-start space-x-4">
                            <div class="w-14 h-14 bg-amber-500/30 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-8 h-8 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <span class="inline-block px-2 py-0.5 bg-amber-500/30 text-amber-400 text-xs font-semibold rounded-full mb-2">VIP</span>
                                <h4 class="text-xl font-bold text-white mb-2">Unlock Premium Tips</h4>
                                <p class="text-slate-400 text-sm mb-4">Get 3-5 daily tips with full analysis and VIP access.</p>
                                <a href="{{ route('pricing') }}" class="inline-flex items-center space-x-2 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-400 hover:to-orange-400 text-slate-900 px-4 py-2 rounded-lg font-semibold text-sm transition">
                                    <span>View Plans</span>
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Quick Stats -->
            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-slate-800/50 backdrop-blur rounded-xl border border-slate-700 p-6">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-slate-400 text-sm">Account Status</p>
                            <p class="text-xl font-bold text-white">
                                @if($activeSubscription)
                                    Active
                                @else
                                    Inactive
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-800/50 backdrop-blur rounded-xl border border-slate-700 p-6">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-slate-400 text-sm">Member Since</p>
                            <p class="text-xl font-bold text-white">{{ $user->created_at->format('M Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-800/50 backdrop-blur rounded-xl border border-slate-700 p-6">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-slate-400 text-sm">Total Subscriptions</p>
                            <p class="text-xl font-bold text-white">{{ $subscriptions->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Subscription History -->
            @if($subscriptions->count() > 0)
                <div class="bg-slate-800/50 backdrop-blur rounded-2xl border border-slate-700 p-6">
                    <h4 class="text-lg font-semibold text-white mb-4">Subscription History</h4>
                    <div class="space-y-4">
                        @foreach($subscriptions as $subscription)
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between p-4 bg-slate-900/50 rounded-xl border border-slate-700">
                                <div>
                                    <p class="font-semibold text-white">{{ $subscription->plan->name }}</p>
                                    <p class="text-slate-400 text-sm">
                                        {{ $subscription->starts_at->format('M d, Y') }} - 
                                        {{ $subscription->ends_at ? $subscription->ends_at->format('M d, Y') : 'Never' }}
                                    </p>
                                </div>
                                <div class="mt-2 sm:mt-0 flex items-center gap-3">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        @if($subscription->status === 'active') bg-green-500/20 text-green-400
                                        @elseif($subscription->status === 'cancelled') bg-red-500/20 text-red-400
                                        @elseif($subscription->status === 'expired') bg-slate-500/20 text-slate-400
                                        @else bg-yellow-500/20 text-yellow-400 @endif">
                                        {{ ucfirst($subscription->status) }}
                                    </span>
                                    @if($subscription->status === 'active' && !$subscription->plan->is_lifetime)
                                        <form action="{{ route('subscription.cancel', $subscription) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this subscription?')">
                                            @csrf
                                            <button type="submit" class="text-red-400 hover:text-red-300 text-sm font-medium">
                                                Cancel
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Quick Actions -->
            <div class="grid md:grid-cols-2 gap-6">
                <a href="{{ route('profile.edit') }}" class="bg-slate-800/50 backdrop-blur rounded-xl border border-slate-700 p-6 hover:border-amber-500/50 transition group">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-slate-700 group-hover:bg-amber-500/20 rounded-xl flex items-center justify-center transition">
                            <svg class="w-6 h-6 text-slate-400 group-hover:text-amber-500 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-white group-hover:text-amber-400 transition">Edit Profile</p>
                            <p class="text-slate-400 text-sm">Update your account details</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('tips.index') }}" class="bg-slate-800/50 backdrop-blur rounded-xl border border-slate-700 p-6 hover:border-amber-500/50 transition group">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-slate-700 group-hover:bg-amber-500/20 rounded-xl flex items-center justify-center transition">
                            <svg class="w-6 h-6 text-slate-400 group-hover:text-amber-500 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-white group-hover:text-amber-400 transition">Browse Tips</p>
                            <p class="text-slate-400 text-sm">View all available tips</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
