<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Telegram Channels') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="text-center mb-12">
                <h3 class="text-3xl font-bold text-white mb-4">Join Our Telegram Community</h3>
                <p class="text-slate-400 max-w-2xl mx-auto">
                    Get instant access to betting tips, community discussions, and exclusive content delivered straight to your Telegram.
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <!-- Free Channel Card -->
                <div class="bg-slate-800/50 backdrop-blur rounded-2xl border border-slate-700 overflow-hidden">
                    <div class="bg-gradient-to-r from-emerald-600 to-green-600 p-6 text-center">
                        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                            </svg>
                        </div>
                        <span class="inline-block px-3 py-1 bg-white/20 rounded-full text-sm font-semibold mb-2">FREE</span>
                        <h4 class="text-2xl font-bold text-white">{{ $freeChannel['name'] ?? 'BetsLab Community' }}</h4>
                    </div>

                    <div class="p-6">
                        <p class="text-slate-400 mb-6">{{ $freeChannel['description'] ?? 'Free tips, discussions, and community access' }}</p>
                        
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-slate-300">1-2 Free tips weekly</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-slate-300">Community discussions</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-slate-300">Results & announcements</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-slate-300">Betting education content</span>
                            </li>
                        </ul>

                        @if($freeChannel['inviteLink'] ?? false)
                            <a href="{{ $freeChannel['inviteLink'] }}" target="_blank" rel="noopener noreferrer" class="block w-full text-center bg-gradient-to-r from-emerald-500 to-green-500 hover:from-emerald-400 hover:to-green-400 text-white px-6 py-3 rounded-xl font-bold transition transform hover:scale-[1.02]">
                                Join Free Channel →
                            </a>
                        @else
                            <div class="text-center py-3 bg-slate-700/50 rounded-xl text-slate-500">
                                Coming Soon
                            </div>
                        @endif
                    </div>
                </div>

                <!-- VIP Channel Card -->
                <div class="bg-slate-800/50 backdrop-blur rounded-2xl border {{ $hasSubscription ? 'border-amber-500' : 'border-slate-700' }} overflow-hidden relative">
                    @if(!$hasSubscription)
                        <div class="absolute inset-0 bg-slate-900/80 backdrop-blur-sm z-10 flex items-center justify-center">
                            <div class="text-center p-6">
                                <div class="w-16 h-16 bg-amber-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <h4 class="text-xl font-bold text-white mb-2">VIP Access Required</h4>
                                <p class="text-slate-400 mb-4">Subscribe to unlock the VIP channel</p>
                                <a href="{{ route('pricing') }}" class="inline-flex items-center space-x-2 bg-gradient-to-r from-amber-500 to-orange-500 text-slate-900 px-6 py-3 rounded-full font-bold hover:from-amber-400 hover:to-orange-400 transition">
                                    <span>View Plans</span>
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="bg-gradient-to-r from-amber-500 to-orange-500 p-6 text-center">
                        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                            </svg>
                        </div>
                        <span class="inline-block px-3 py-1 bg-slate-900/30 rounded-full text-sm font-semibold mb-2">VIP</span>
                        <h4 class="text-2xl font-bold text-slate-900">{{ $vipChannel['name'] ?? 'BetsLab VIP' }}</h4>
                    </div>

                    <div class="p-6">
                        <p class="text-slate-400 mb-6">{{ $vipChannel['description'] ?? 'Premium tips with full analysis' }}</p>
                        
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-amber-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-slate-300"><strong>3-5 Premium tips daily</strong></span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-amber-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-slate-300">Full analysis & reasoning</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-amber-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-slate-300">High-value accumulators</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-amber-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-slate-300">Live in-play alerts</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-amber-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-slate-300">Priority support</span>
                            </li>
                        </ul>

                        @if($hasSubscription && ($vipChannel['inviteLink'] ?? false))
                            <a href="{{ $vipChannel['inviteLink'] }}" target="_blank" rel="noopener noreferrer" class="block w-full text-center bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-400 hover:to-orange-400 text-slate-900 px-6 py-3 rounded-xl font-bold transition transform hover:scale-[1.02]">
                                Join VIP Channel →
                            </a>
                        @elseif($hasSubscription)
                            <div class="text-center py-3 bg-slate-700/50 rounded-xl text-slate-500">
                                Link coming soon - Contact support
                            </div>
                        @else
                            <div class="text-center py-3 bg-slate-700/50 rounded-xl text-slate-500">
                                🔒 Subscription required
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Help Section -->
            <div class="mt-12 bg-slate-800/30 rounded-xl border border-slate-700 p-6">
                <h4 class="text-lg font-semibold text-white mb-4">📱 How to Join</h4>
                <ol class="space-y-3 text-slate-400">
                    <li class="flex items-start space-x-3">
                        <span class="bg-slate-700 text-white w-6 h-6 rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0">1</span>
                        <span>Make sure you have Telegram installed on your device</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <span class="bg-slate-700 text-white w-6 h-6 rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0">2</span>
                        <span>Click the "Join" button for the channel you want to access</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <span class="bg-slate-700 text-white w-6 h-6 rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0">3</span>
                        <span>Confirm joining in the Telegram app - you'll start receiving tips immediately!</span>
                    </li>
                </ol>
                <p class="text-slate-500 text-sm mt-4">
                    Having trouble? Contact us at <a href="mailto:support@betslab.io" class="text-amber-400 hover:text-amber-300">support@betslab.io</a>
                </p>
            </div>

            <!-- Back Button -->
            <div class="mt-6 text-center">
                <a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-white transition inline-flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Back to Dashboard</span>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
