<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pricing - BetsLab.io | Premium Sports Betting Tips</title>
    <meta name="description" content="Choose your BetsLab membership. One winning tip pays for your entire subscription. 30-day money-back guarantee.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .gradient-text {
            background: linear-gradient(135deg, #f59e0b 0%, #ef4444 50%, #f59e0b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .pricing-card-popular {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(239, 68, 68, 0.1) 100%);
        }
    </style>
</head>
<body class="font-sans antialiased bg-slate-900 text-white">
    <!-- Navigation -->
    <nav class="bg-slate-900/95 backdrop-blur-md border-b border-slate-800 fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <span class="text-2xl font-bold gradient-text">BetsLab</span>
                        <span class="text-xs bg-amber-400 text-slate-900 px-2 py-0.5 rounded-full font-bold">PRO</span>
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}#how-it-works" class="text-slate-300 hover:text-amber-400 transition font-medium">How It Works</a>
                    <a href="{{ route('home') }}#results" class="text-slate-300 hover:text-amber-400 transition font-medium">Results</a>
                    <a href="{{ route('about') }}" class="text-slate-300 hover:text-amber-400 transition font-medium">Our Story</a>
                    <a href="{{ route('pricing') }}" class="text-amber-400 font-medium">Pricing</a>
                    @guest
                        <a href="{{ route('login') }}" class="text-slate-300 hover:text-white transition font-medium">Login</a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-400 hover:to-orange-400 text-slate-900 px-6 py-2 rounded-full font-bold transition transform hover:scale-105">
                            Start Winning
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-400 hover:to-orange-400 text-slate-900 px-6 py-2 rounded-full font-bold transition transform hover:scale-105">
                            Dashboard
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-flex items-center space-x-2 bg-green-500/20 text-green-400 px-4 py-2 rounded-full mb-6">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span class="font-semibold">30-Day Money-Back Guarantee</span>
            </span>
            <h1 class="text-5xl md:text-6xl font-black mb-6">
                Invest in Your <span class="gradient-text">Winning Future</span>
            </h1>
            <p class="text-xl text-slate-400 max-w-2xl mx-auto">
                One winning tip covers your entire subscription. Join 2,847+ members who are growing their bankroll with data-driven predictions.
            </p>
        </div>
    </section>

    <!-- Pricing Cards -->
    <section class="py-16">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-500/20 border border-green-500/50 text-green-400 px-6 py-4 rounded-xl mb-8 text-center">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-500/20 border border-red-500/50 text-red-400 px-6 py-4 rounded-xl mb-8 text-center">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid md:grid-cols-2 gap-8">
                @foreach($plans as $plan)
                    <div class="relative {{ $plan->slug === 'lifetime' ? 'pricing-card-popular border-amber-500' : 'border-slate-700' }} bg-slate-800/50 backdrop-blur rounded-2xl p-8 border">
                        @if($plan->slug === 'lifetime')
                            <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                                <span class="bg-gradient-to-r from-amber-500 to-orange-500 text-slate-900 px-6 py-2 rounded-full text-sm font-bold shadow-lg shadow-amber-500/25">
                                    ⭐ MOST POPULAR
                                </span>
                            </div>
                        @endif

                        <div class="text-center mb-8">
                            <h3 class="text-2xl font-bold mb-2">{{ $plan->name }}</h3>
                            <p class="text-slate-400">
                                @if($plan->slug === 'monthly')
                                    Perfect for trying out our service. Full access to all premium tips.
                                @else
                                    One payment, forever access. Best value for serious bettors.
                                @endif
                            </p>
                        </div>

                        <div class="text-center mb-8">
                            <div class="flex items-baseline justify-center">
                                <span class="text-slate-400 text-2xl mr-1">$</span>
                                <span class="text-6xl font-black">{{ number_format($plan->price, 0) }}</span>
                                @if($plan->is_lifetime)
                                    <span class="text-slate-400 ml-2">one-time</span>
                                @else
                                    <span class="text-slate-400 ml-2">/month</span>
                                @endif
                            </div>
                            @if($plan->slug === 'lifetime')
                                <p class="text-green-400 text-sm mt-2 font-semibold">Save $289 compared to 12 months</p>
                            @endif
                        </div>

                        <ul class="space-y-4 mb-8">
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-slate-300">3-5 Premium Tips Daily</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-slate-300">VIP Telegram Channel Access</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-slate-300">Full Analysis & Reasoning</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-slate-300">Live Support</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-slate-300">Historical Results Access</span>
                            </li>
                            @if($plan->slug === 'lifetime')
                                <li class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-amber-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-amber-400 font-semibold">Lifetime Access - Never Pay Again!</span>
                                </li>
                                <li class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-amber-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-amber-400 font-semibold">Priority Support</span>
                                </li>
                            @endif
                        </ul>

                        @auth
                            <form action="{{ route('subscription.checkout') }}" method="POST">
                                @csrf
                                <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                <input type="hidden" name="gateway" value="revolut">
                                <button type="submit" class="w-full {{ $plan->slug === 'lifetime' ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-slate-900 hover:from-amber-400 hover:to-orange-400' : 'bg-slate-700 text-white hover:bg-slate-600' }} px-6 py-4 rounded-xl font-bold text-lg transition transform hover:scale-[1.02]">
                                    Get Started Now
                                </button>
                            </form>
                        @else
                            <a href="{{ route('register') }}" class="block w-full text-center {{ $plan->slug === 'lifetime' ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-slate-900 hover:from-amber-400 hover:to-orange-400' : 'bg-slate-700 text-white hover:bg-slate-600' }} px-6 py-4 rounded-xl font-bold text-lg transition transform hover:scale-[1.02]">
                                Get Started Now
                            </a>
                        @endauth
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Trust Badges -->
    <section class="py-16 bg-slate-800/30">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="w-16 h-16 bg-green-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h4 class="font-bold mb-2">Secure Payment</h4>
                    <p class="text-slate-400 text-sm">256-bit SSL encryption</p>
                </div>
                <div>
                    <div class="w-16 h-16 bg-amber-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h4 class="font-bold mb-2">Money-Back Guarantee</h4>
                    <p class="text-slate-400 text-sm">30 days, no questions asked</p>
                </div>
                <div>
                    <div class="w-16 h-16 bg-blue-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h4 class="font-bold mb-2">Instant Access</h4>
                    <p class="text-slate-400 text-sm">Start receiving tips immediately</p>
                </div>
                <div>
                    <div class="w-16 h-16 bg-purple-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h4 class="font-bold mb-2">24/7 Support</h4>
                    <p class="text-slate-400 text-sm">We're here to help</p>
                </div>
            </div>
        </div>
    </section>

    <!-- What You Get -->
    <section class="py-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-amber-400 font-semibold text-sm uppercase tracking-wider">Everything Included</span>
                <h2 class="text-4xl font-bold mt-4">What You Get as a Member</h2>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-slate-800/50 rounded-xl p-6 border border-slate-700 flex space-x-4">
                    <div class="w-12 h-12 bg-amber-500/20 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg mb-2">3-5 Daily Premium Tips</h4>
                        <p class="text-slate-400">Carefully selected high-value bets across Football, Basketball, Tennis, and eSports.</p>
                    </div>
                </div>

                <div class="bg-slate-800/50 rounded-xl p-6 border border-slate-700 flex space-x-4">
                    <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg mb-2">VIP Telegram Channel</h4>
                        <p class="text-slate-400">Instant notifications. Never miss a tip. Join a community of 2,847+ winning bettors.</p>
                    </div>
                </div>

                <div class="bg-slate-800/50 rounded-xl p-6 border border-slate-700 flex space-x-4">
                    <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg mb-2">Full Analysis & Reasoning</h4>
                        <p class="text-slate-400">Understand why we pick each bet. Learn from our analysis and improve your own skills.</p>
                    </div>
                </div>

                <div class="bg-slate-800/50 rounded-xl p-6 border border-slate-700 flex space-x-4">
                    <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg mb-2">Full Historical Results</h4>
                        <p class="text-slate-400">Access to all our past tips. Full transparency on our track record. See every win and loss.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="py-20 bg-slate-800/30">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-amber-400 font-semibold text-sm uppercase tracking-wider">FAQ</span>
                <h2 class="text-4xl font-bold mt-4">Frequently Asked Questions</h2>
            </div>

            <div class="space-y-4" x-data="{ open: null }">
                <div class="bg-slate-800/50 rounded-xl border border-slate-700">
                    <button @click="open = open === 1 ? null : 1" class="w-full px-6 py-4 text-left flex justify-between items-center">
                        <span class="font-semibold">Can I cancel my subscription anytime?</span>
                        <svg class="w-5 h-5 transform transition" :class="open === 1 ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open === 1" x-collapse class="px-6 pb-4 text-slate-400">
                        Yes! Monthly subscriptions can be cancelled at any time from your dashboard. Your access continues until the end of the billing period.
                    </div>
                </div>

                <div class="bg-slate-800/50 rounded-xl border border-slate-700">
                    <button @click="open = open === 2 ? null : 2" class="w-full px-6 py-4 text-left flex justify-between items-center">
                        <span class="font-semibold">What payment methods do you accept?</span>
                        <svg class="w-5 h-5 transform transition" :class="open === 2 ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open === 2" x-collapse class="px-6 pb-4 text-slate-400">
                        We accept all major credit/debit cards (Visa, Mastercard, American Express) through our secure payment processor. We also support Apple Pay and Google Pay.
                    </div>
                </div>

                <div class="bg-slate-800/50 rounded-xl border border-slate-700">
                    <button @click="open = open === 3 ? null : 3" class="w-full px-6 py-4 text-left flex justify-between items-center">
                        <span class="font-semibold">How does the money-back guarantee work?</span>
                        <svg class="w-5 h-5 transform transition" :class="open === 3 ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open === 3" x-collapse class="px-6 pb-4 text-slate-400">
                        If you're not satisfied within the first 30 days, simply contact us and we'll refund your payment in full. No questions asked, no hoops to jump through.
                    </div>
                </div>

                <div class="bg-slate-800/50 rounded-xl border border-slate-700">
                    <button @click="open = open === 4 ? null : 4" class="w-full px-6 py-4 text-left flex justify-between items-center">
                        <span class="font-semibold">When do I get access after subscribing?</span>
                        <svg class="w-5 h-5 transform transition" :class="open === 4 ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open === 4" x-collapse class="px-6 pb-4 text-slate-400">
                        Immediately! As soon as your payment is confirmed, you'll get access to your dashboard and the VIP Telegram channel. You'll be ready to receive tips within minutes.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="py-24">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">
                Still Thinking? <span class="gradient-text">Don't Miss Today's Tips</span>
            </h2>
            <p class="text-xl text-slate-400 mb-8 max-w-2xl mx-auto">
                Every day you wait is a day of potential profits missed. Join now and start your winning streak today.
            </p>
            <a href="{{ route('register') }}" class="inline-flex items-center space-x-2 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-400 hover:to-orange-400 text-slate-900 px-8 py-4 rounded-full font-bold text-lg transition transform hover:scale-105 shadow-lg shadow-amber-500/25">
                <span>Start Winning Today</span>
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </a>
            <p class="text-slate-500 mt-4 text-sm">
                🔒 Secure payment • 30-day money-back guarantee • Cancel anytime
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 border-t border-slate-800 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center text-slate-500 text-sm">
                <p>&copy; {{ date('Y') }} BetsLab.io. All rights reserved. Bet responsibly. 18+</p>
            </div>
        </div>
    </footer>
</body>
</html>
