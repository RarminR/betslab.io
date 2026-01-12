<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BetsLab.io - Premium Sports Betting Tips from Professional Analysts</title>
    <meta name="description" content="Join thousands of winning bettors. Get daily premium sports betting tips with 67% win rate from our expert analyst team.">

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
        .hero-glow {
            background: radial-gradient(ellipse at center, rgba(245, 158, 11, 0.15) 0%, transparent 70%);
        }
        .card-glow:hover {
            box-shadow: 0 0 40px rgba(245, 158, 11, 0.2);
        }
        .stat-card {
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.8) 0%, rgba(15, 23, 42, 0.9) 100%);
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
        .testimonial-gradient {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        }
    </style>
</head>
<body class="font-sans antialiased bg-slate-900 text-white overflow-x-hidden">
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
                    <a href="#how-it-works" class="text-slate-300 hover:text-amber-400 transition font-medium">How It Works</a>
                    <a href="#results" class="text-slate-300 hover:text-amber-400 transition font-medium">Results</a>
                    <a href="{{ route('about') }}" class="text-slate-300 hover:text-amber-400 transition font-medium">Our Story</a>
                    <a href="{{ route('pricing') }}" class="text-slate-300 hover:text-amber-400 transition font-medium">Pricing</a>
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
                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button type="button" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="text-slate-400 hover:text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-slate-800 border-t border-slate-700">
            <div class="px-4 py-4 space-y-3">
                <a href="#how-it-works" class="block text-slate-300 hover:text-amber-400">How It Works</a>
                <a href="#results" class="block text-slate-300 hover:text-amber-400">Results</a>
                <a href="{{ route('about') }}" class="block text-slate-300 hover:text-amber-400">Our Story</a>
                <a href="{{ route('pricing') }}" class="block text-slate-300 hover:text-amber-400">Pricing</a>
                @guest
                    <a href="{{ route('login') }}" class="block text-slate-300">Login</a>
                    <a href="{{ route('register') }}" class="block bg-amber-500 text-slate-900 px-4 py-2 rounded-full font-bold text-center">Start Winning</a>
                @else
                    <a href="{{ route('dashboard') }}" class="block bg-amber-500 text-slate-900 px-4 py-2 rounded-full font-bold text-center">Dashboard</a>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center pt-16">
        <div class="absolute inset-0 hero-glow"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23334155\" fill-opacity=\"0.1\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-50"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center">
                <!-- Badge -->
                <div class="inline-flex items-center space-x-2 bg-slate-800/80 backdrop-blur px-4 py-2 rounded-full mb-8 border border-slate-700">
                    <span class="flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-2 w-2 rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                    </span>
                    <span class="text-slate-300 text-sm font-medium">Live tips available now</span>
                </div>

                <!-- Main Headline -->
                <h1 class="text-5xl md:text-7xl font-black mb-6 leading-tight">
                    Stop Guessing.<br>
                    <span class="gradient-text">Start Winning.</span>
                </h1>
                
                <p class="text-xl md:text-2xl text-slate-400 max-w-3xl mx-auto mb-8 leading-relaxed">
                    Join <span class="text-amber-400 font-semibold">2,847+ bettors</span> who turned their hobby into consistent profits with our data-driven sports predictions.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-12">
                    <a href="{{ route('register') }}" class="group bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-400 hover:to-orange-400 text-slate-900 px-8 py-4 rounded-full font-bold text-lg transition transform hover:scale-105 flex items-center space-x-2 shadow-lg shadow-amber-500/25">
                        <span>Get Your First Tips Free</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                    <a href="#how-it-works" class="text-slate-300 hover:text-white px-8 py-4 rounded-full font-semibold border border-slate-700 hover:border-slate-500 transition flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>See How It Works</span>
                    </a>
                </div>

                <!-- Trust Badges -->
                <div class="flex flex-wrap items-center justify-center gap-8 text-slate-500">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span>No credit card required</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span>Cancel anytime</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span>VIP Telegram access</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-slate-800/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-black gradient-text mb-2">67%</div>
                    <div class="text-slate-400">Win Rate</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-black text-white mb-2">2,847+</div>
                    <div class="text-slate-400">Active Members</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-black text-white mb-2">15K+</div>
                    <div class="text-slate-400">Tips Delivered</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-black text-green-400 mb-2">+31%</div>
                    <div class="text-slate-400">Avg. Monthly ROI</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Problem/Solution Section -->
    <section class="py-24 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div>
                    <span class="text-amber-400 font-semibold text-sm uppercase tracking-wider">The Problem</span>
                    <h2 class="text-4xl md:text-5xl font-bold mt-4 mb-6">
                        95% of Bettors Lose Money Every Year
                    </h2>
                    <p class="text-xl text-slate-400 mb-8">
                        They rely on gut feelings, chase losses, and lack the data analysis skills to make informed decisions. Sound familiar?
                    </p>
                    <ul class="space-y-4">
                        <li class="flex items-start space-x-3">
                            <svg class="w-6 h-6 text-red-500 flex-shrink-0 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            <span class="text-slate-300">Spending hours researching with no clear strategy</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-6 h-6 text-red-500 flex-shrink-0 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            <span class="text-slate-300">Following "experts" who never show their track record</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-6 h-6 text-red-500 flex-shrink-0 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            <span class="text-slate-300">Emotional betting after losses destroys your bankroll</span>
                        </li>
                    </ul>
                </div>
                <div class="relative">
                    <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl p-8 border border-slate-700">
                        <span class="text-green-400 font-semibold text-sm uppercase tracking-wider">The Solution</span>
                        <h3 class="text-3xl font-bold mt-4 mb-6">
                            Data-Driven Tips from Real Analysts
                        </h3>
                        <p class="text-slate-400 mb-6">
                            Our team of 5 professional sports analysts spend 40+ hours weekly analyzing data so you don't have to. Just follow the tips.
                        </p>
                        <ul class="space-y-4 mb-8">
                            <li class="flex items-start space-x-3">
                                <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-slate-300">3-5 carefully selected tips daily</span>
                            </li>
                            <li class="flex items-start space-x-3">
                                <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-slate-300">Full transparency - all results published</span>
                            </li>
                            <li class="flex items-start space-x-3">
                                <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-slate-300">Instant delivery via Telegram</span>
                            </li>
                        </ul>
                        <a href="{{ route('register') }}" class="inline-flex items-center space-x-2 bg-gradient-to-r from-amber-500 to-orange-500 text-slate-900 px-6 py-3 rounded-full font-bold hover:from-amber-400 hover:to-orange-400 transition">
                            <span>Start Your Free Trial</span>
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="py-24 bg-slate-800/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-amber-400 font-semibold text-sm uppercase tracking-wider">Simple Process</span>
                <h2 class="text-4xl md:text-5xl font-bold mt-4">How It Works</h2>
                <p class="text-xl text-slate-400 mt-4 max-w-2xl mx-auto">
                    From signup to profit in three simple steps
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 relative">
                <!-- Step 1 -->
                <div class="relative">
                    <div class="bg-slate-800/50 backdrop-blur rounded-2xl p-8 border border-slate-700 hover:border-amber-500/50 transition card-glow h-full">
                        <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-orange-500 rounded-xl flex items-center justify-center text-slate-900 font-black text-xl mb-6">
                            1
                        </div>
                        <h3 class="text-2xl font-bold mb-4">Create Your Account</h3>
                        <p class="text-slate-400">
                            Sign up in 30 seconds. No credit card needed for the free trial. Get instant access to our community.
                        </p>
                    </div>
                </div>

                <!-- Arrow 1 -->
                <div class="hidden md:flex absolute left-[33.33%] top-1/2 -translate-x-1/2 -translate-y-1/2 z-10">
                    <svg class="w-8 h-8 text-amber-500/60" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </div>

                <!-- Step 2 -->
                <div class="relative">
                    <div class="bg-slate-800/50 backdrop-blur rounded-2xl p-8 border border-slate-700 hover:border-amber-500/50 transition card-glow h-full">
                        <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-orange-500 rounded-xl flex items-center justify-center text-slate-900 font-black text-xl mb-6">
                            2
                        </div>
                        <h3 class="text-2xl font-bold mb-4">Join Our VIP Telegram</h3>
                        <p class="text-slate-400">
                            Get instant access to our private Telegram channel where all premium tips are posted in real-time.
                        </p>
                    </div>
                </div>

                <!-- Arrow 2 -->
                <div class="hidden md:flex absolute left-[66.66%] top-1/2 -translate-x-1/2 -translate-y-1/2 z-10">
                    <svg class="w-8 h-8 text-amber-500/60" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </div>

                <!-- Step 3 -->
                <div>
                    <div class="bg-slate-800/50 backdrop-blur rounded-2xl p-8 border border-slate-700 hover:border-amber-500/50 transition card-glow h-full">
                        <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-orange-500 rounded-xl flex items-center justify-center text-slate-900 font-black text-xl mb-6">
                            3
                        </div>
                        <h3 class="text-2xl font-bold mb-4">Follow & Profit</h3>
                        <p class="text-slate-400">
                            Receive daily tips with full analysis. Place your bets and watch your bankroll grow consistently.
                        </p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('register') }}" class="inline-flex items-center space-x-2 bg-gradient-to-r from-amber-500 to-orange-500 text-slate-900 px-8 py-4 rounded-full font-bold text-lg hover:from-amber-400 hover:to-orange-400 transition transform hover:scale-105">
                    <span>Get Started Now</span>
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Results Section -->
    <section id="results" class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-amber-400 font-semibold text-sm uppercase tracking-wider">Proven Track Record</span>
                <h2 class="text-4xl md:text-5xl font-bold mt-4">Recent Results</h2>
                <p class="text-xl text-slate-400 mt-4">
                    Full transparency. All our tips are tracked and verified.
                </p>
            </div>

            <!-- Recent Tips -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                @forelse($latestTips as $tip)
                    <div class="bg-slate-800/50 backdrop-blur rounded-xl p-6 border border-slate-700">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-slate-400 text-sm">{{ $tip->sport }}</span>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                @if($tip->result === 'won') bg-green-500/20 text-green-400
                                @elseif($tip->result === 'lost') bg-red-500/20 text-red-400
                                @else bg-blue-500/20 text-blue-400 @endif">
                                {{ ucfirst($tip->result) }}
                            </span>
                        </div>
                        <h4 class="font-semibold text-lg mb-2">{{ $tip->title }}</h4>
                        <div class="flex items-center gap-2 text-slate-400 text-sm mb-4">
                            <span class="text-amber-400 font-bold">@ {{ number_format($tip->total_odds, 2) }}</span>
                            <span>•</span>
                            <span>{{ $tip->published_at?->format('M d, Y') ?? 'Draft' }}</span>
                        </div>
                        @foreach($tip->selections->take(2) as $selection)
                            <div class="flex justify-between items-center text-sm py-2 border-t border-slate-700">
                                <div>
                                    <span class="text-slate-300">{{ $selection->event_name }}</span>
                                    <span class="text-slate-500 text-xs block">{{ $selection->prediction }}</span>
                                </div>
                                <span class="text-amber-400 font-semibold">@ {{ number_format($selection->odds, 2) }}</span>
                            </div>
                        @endforeach
                        @if($tip->selections->count() > 2)
                            <p class="text-slate-500 text-xs mt-2">+{{ $tip->selections->count() - 2 }} more selections</p>
                        @endif
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-slate-400">New tips coming soon! Subscribe to get notified.</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center">
                <a href="{{ route('tips.index') }}" class="inline-flex items-center space-x-2 text-amber-400 hover:text-amber-300 font-semibold">
                    <span>View All Results</span>
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-24 bg-slate-800/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-amber-400 font-semibold text-sm uppercase tracking-wider">What Members Say</span>
                <h2 class="text-4xl md:text-5xl font-bold mt-4">Real Results, Real Stories</h2>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="testimonial-gradient rounded-2xl p-8 border border-slate-700">
                    <div class="flex items-center mb-4">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <p class="text-slate-300 mb-6 italic">
                        "I was skeptical at first, but after 3 months my bankroll has grown by 45%. The tips are well-researched and the Telegram community is incredibly supportive."
                    </p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-orange-500 rounded-full flex items-center justify-center text-slate-900 font-bold">
                            MK
                        </div>
                        <div class="ml-4">
                            <div class="font-semibold">Michael K.</div>
                            <div class="text-slate-500 text-sm">Member for 8 months</div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="testimonial-gradient rounded-2xl p-8 border border-slate-700">
                    <div class="flex items-center mb-4">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <p class="text-slate-300 mb-6 italic">
                        "Best decision I ever made. The analysis is top-notch and the team actually cares about your success. No other tipster comes close."
                    </p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-500 rounded-full flex items-center justify-center text-slate-900 font-bold">
                            ST
                        </div>
                        <div class="ml-4">
                            <div class="font-semibold">Sarah T.</div>
                            <div class="text-slate-500 text-sm">Member for 1 year</div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="testimonial-gradient rounded-2xl p-8 border border-slate-700">
                    <div class="flex items-center mb-4">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <p class="text-slate-300 mb-6 italic">
                        "I've tried many services before. BetsLab is different - they're transparent about everything. The monthly ROI has been consistently positive."
                    </p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-full flex items-center justify-center text-slate-900 font-bold">
                            DJ
                        </div>
                        <div class="ml-4">
                            <div class="font-semibold">David J.</div>
                            <div class="text-slate-500 text-sm">Member for 6 months</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Meet The Team Preview -->
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div>
                    <span class="text-amber-400 font-semibold text-sm uppercase tracking-wider">Our Story</span>
                    <h2 class="text-4xl md:text-5xl font-bold mt-4 mb-6">
                        3 Years of Winning Tips. Now Available to You.
                    </h2>
                    <p class="text-xl text-slate-400 mb-6">
                        BetsLab started in 2023 as a passion project — just us sharing winning tips with close friends. Word spread, results spoke for themselves, and our community grew organically.
                    </p>
                    <p class="text-slate-400 mb-8">
                        After 3 years of consistent profits and countless requests, we officially launched BetsLab.io in 2026. Now everyone can access the same premium analysis that helped our inner circle win big. Our data-driven approach and transparent results have already attracted thousands of happy members.
                    </p>
                    <a href="{{ route('about') }}" class="inline-flex items-center space-x-2 text-amber-400 hover:text-amber-300 font-semibold">
                        <span>Read Our Full Story</span>
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-slate-800 rounded-2xl p-6 border border-slate-700 float-animation">
                        <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-orange-500 rounded-full flex items-center justify-center text-slate-900 font-bold text-xl mb-4">
                            AC
                        </div>
                        <h4 class="font-bold text-lg">Alex Chen</h4>
                        <p class="text-slate-400 text-sm">Lead Football Analyst</p>
                        <p class="text-amber-400 text-sm mt-2">71% Win Rate</p>
                    </div>
                    <div class="bg-slate-800 rounded-2xl p-6 border border-slate-700 float-animation" style="animation-delay: 0.5s;">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-full flex items-center justify-center text-slate-900 font-bold text-xl mb-4">
                            MR
                        </div>
                        <h4 class="font-bold text-lg">Maria Rodriguez</h4>
                        <p class="text-slate-400 text-sm">Basketball Expert</p>
                        <p class="text-amber-400 text-sm mt-2">68% Win Rate</p>
                    </div>
                    <div class="bg-slate-800 rounded-2xl p-6 border border-slate-700 float-animation" style="animation-delay: 1s;">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-500 rounded-full flex items-center justify-center text-slate-900 font-bold text-xl mb-4">
                            JW
                        </div>
                        <h4 class="font-bold text-lg">James Wilson</h4>
                        <p class="text-slate-400 text-sm">Tennis Specialist</p>
                        <p class="text-amber-400 text-sm mt-2">65% Win Rate</p>
                    </div>
                    <div class="bg-slate-800 rounded-2xl p-6 border border-slate-700 float-animation" style="animation-delay: 1.5s;">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-slate-900 font-bold text-xl mb-4">
                            SK
                        </div>
                        <h4 class="font-bold text-lg">Sophie Kim</h4>
                        <p class="text-slate-400 text-sm">eSports Analyst</p>
                        <p class="text-amber-400 text-sm mt-2">72% Win Rate</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Preview -->
    <section class="py-24 bg-slate-800/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-amber-400 font-semibold text-sm uppercase tracking-wider">Simple Pricing</span>
                <h2 class="text-4xl md:text-5xl font-bold mt-4">Invest in Your Winning Future</h2>
                <p class="text-xl text-slate-400 mt-4">
                    One winning tip pays for your entire subscription
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                @foreach($plans as $plan)
                    <div class="bg-slate-800/50 backdrop-blur rounded-2xl p-8 border {{ $plan->slug === 'lifetime' ? 'border-amber-500' : 'border-slate-700' }} relative">
                        @if($plan->slug === 'lifetime')
                            <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                                <span class="bg-gradient-to-r from-amber-500 to-orange-500 text-slate-900 px-4 py-1 rounded-full text-sm font-bold">
                                    BEST VALUE
                                </span>
                            </div>
                        @endif
                        <h3 class="text-2xl font-bold mb-2">{{ $plan->name }}</h3>
                        <p class="text-slate-400 mb-6">{{ $plan->description }}</p>
                        <div class="mb-6">
                            <span class="text-5xl font-black">${{ number_format($plan->price, 0) }}</span>
                            @if(!$plan->is_lifetime)
                                <span class="text-slate-400">/month</span>
                            @else
                                <span class="text-slate-400"> one-time</span>
                            @endif
                        </div>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-slate-300">3-5 Daily Premium Tips</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-slate-300">VIP Telegram Channel</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-slate-300">Full Analysis & Reasoning</span>
                            </li>
                            @if($plan->slug === 'lifetime')
                                <li class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-amber-400 font-semibold">Lifetime Access - Never Pay Again</span>
                                </li>
                            @endif
                        </ul>
                        <a href="{{ route('register') }}" class="block w-full text-center {{ $plan->slug === 'lifetime' ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-slate-900' : 'bg-slate-700 text-white hover:bg-slate-600' }} px-6 py-3 rounded-full font-bold transition">
                            Get Started
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-8">
                <p class="text-slate-400">
                    💰 30-day money-back guarantee. No questions asked.
                </p>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-24">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-amber-400 font-semibold text-sm uppercase tracking-wider">FAQ</span>
                <h2 class="text-4xl md:text-5xl font-bold mt-4">Common Questions</h2>
            </div>

            <div class="space-y-4" x-data="{ open: null }">
                <div class="bg-slate-800/50 rounded-xl border border-slate-700">
                    <button @click="open = open === 1 ? null : 1" class="w-full px-6 py-4 text-left flex justify-between items-center">
                        <span class="font-semibold">How do I receive the tips?</span>
                        <svg class="w-5 h-5 transform transition" :class="open === 1 ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open === 1" x-collapse class="px-6 pb-4 text-slate-400">
                        All tips are delivered instantly via our private Telegram channel. You'll receive a notification the moment a new tip is posted, ensuring you never miss an opportunity.
                    </div>
                </div>

                <div class="bg-slate-800/50 rounded-xl border border-slate-700">
                    <button @click="open = open === 2 ? null : 2" class="w-full px-6 py-4 text-left flex justify-between items-center">
                        <span class="font-semibold">What sports do you cover?</span>
                        <svg class="w-5 h-5 transform transition" :class="open === 2 ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open === 2" x-collapse class="px-6 pb-4 text-slate-400">
                        We primarily focus on Football (Soccer), Basketball (NBA, EuroLeague), Tennis (ATP, WTA), and eSports (CS2, League of Legends, Dota 2). Our analysts specialize in their respective sports for maximum accuracy.
                    </div>
                </div>

                <div class="bg-slate-800/50 rounded-xl border border-slate-700">
                    <button @click="open = open === 3 ? null : 3" class="w-full px-6 py-4 text-left flex justify-between items-center">
                        <span class="font-semibold">Can I cancel my subscription?</span>
                        <svg class="w-5 h-5 transform transition" :class="open === 3 ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open === 3" x-collapse class="px-6 pb-4 text-slate-400">
                        Absolutely! You can cancel your monthly subscription anytime from your dashboard. We also offer a 30-day money-back guarantee if you're not satisfied with our service.
                    </div>
                </div>

                <div class="bg-slate-800/50 rounded-xl border border-slate-700">
                    <button @click="open = open === 4 ? null : 4" class="w-full px-6 py-4 text-left flex justify-between items-center">
                        <span class="font-semibold">What's your win rate?</span>
                        <svg class="w-5 h-5 transform transition" :class="open === 4 ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open === 4" x-collapse class="px-6 pb-4 text-slate-400">
                        Our overall win rate across all sports is 67%. This is tracked and verified - we publish all our results publicly. Individual analysts have win rates ranging from 65% to 72% depending on their sport specialty.
                    </div>
                </div>

                <div class="bg-slate-800/50 rounded-xl border border-slate-700">
                    <button @click="open = open === 5 ? null : 5" class="w-full px-6 py-4 text-left flex justify-between items-center">
                        <span class="font-semibold">How much should I bet per tip?</span>
                        <svg class="w-5 h-5 transform transition" :class="open === 5 ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open === 5" x-collapse class="px-6 pb-4 text-slate-400">
                        We recommend betting 1-3% of your bankroll per tip. We provide confidence ratings with each tip so you can adjust accordingly. Bankroll management is key to long-term success.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="py-24 bg-gradient-to-b from-slate-800/50 to-slate-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">
                Ready to <span class="gradient-text">Start Winning</span>?
            </h2>
            <p class="text-xl text-slate-400 mb-8 max-w-2xl mx-auto">
                Join 2,847+ members who are already growing their bankroll with our premium tips. Your winning streak starts today.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-8">
                <a href="{{ route('register') }}" class="group bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-400 hover:to-orange-400 text-slate-900 px-8 py-4 rounded-full font-bold text-lg transition transform hover:scale-105 flex items-center space-x-2 shadow-lg shadow-amber-500/25">
                    <span>Get Your First Tips Free</span>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
                <a href="{{ route('pricing') }}" class="text-slate-300 hover:text-white px-8 py-4 rounded-full font-semibold border border-slate-700 hover:border-slate-500 transition">
                    View Pricing
                </a>
            </div>
            <div class="flex items-center justify-center space-x-6 text-slate-500 text-sm">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span>No credit card required</span>
                </div>
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span>30-day money-back guarantee</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 border-t border-slate-800 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div class="col-span-2 md:col-span-1">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2 mb-4">
                        <span class="text-2xl font-bold gradient-text">BetsLab</span>
                    </a>
                    <p class="text-slate-400 text-sm">
                        Premium sports betting tips from professional analysts. Sharing winning picks with friends since 2023, now available to everyone.
                    </p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-slate-400">
                        <li><a href="{{ route('pricing') }}" class="hover:text-amber-400 transition">Pricing</a></li>
                        <li><a href="{{ route('tips.index') }}" class="hover:text-amber-400 transition">Results</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-amber-400 transition">About Us</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Legal</h4>
                    <ul class="space-y-2 text-slate-400">
                        <li><a href="#" class="hover:text-amber-400 transition">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-amber-400 transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-amber-400 transition">Responsible Gambling</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Connect</h4>
                    <ul class="space-y-2 text-slate-400">
                        <li><a href="#" class="hover:text-amber-400 transition flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>
                            <span>Telegram</span>
                        </a></li>
                        <li><a href="#" class="hover:text-amber-400 transition flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            <span>Twitter</span>
                        </a></li>
                        <li><a href="mailto:support@betslab.io" class="hover:text-amber-400 transition flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span>support@betslab.io</span>
                        </a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-slate-800 mt-8 pt-8 text-center text-slate-500 text-sm">
                <p>&copy; {{ date('Y') }} BetsLab.io. All rights reserved. Bet responsibly. 18+</p>
            </div>
        </div>
    </footer>
</body>
</html>
