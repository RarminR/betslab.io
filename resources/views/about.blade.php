<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Our Story - BetsLab.io | 3 Years of Winning Tips</title>
    <meta name="description" content="BetsLab started in 2023 sharing tips with friends. After 3 years of proven results, we officially launched in 2026. Join our winning community.">

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
        .timeline-line {
            background: linear-gradient(180deg, #f59e0b 0%, #1e293b 100%);
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
                    <a href="{{ route('about') }}" class="text-amber-400 font-medium">Our Story</a>
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
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23334155\" fill-opacity=\"0.1\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-50"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative">
            <span class="text-amber-400 font-semibold text-sm uppercase tracking-wider">Our Story</span>
            <h1 class="text-5xl md:text-6xl font-black mt-4 mb-6">
                <span class="gradient-text">3 Years</span> of Sharing<br>
                Winning Tips with Friends
            </h1>
            <p class="text-xl text-slate-400 max-w-3xl mx-auto">
                What started as helping our close circle in 2023 has grown into a community of thousands. Now it's your turn to join.
            </p>
        </div>
    </section>

    <!-- Timeline Section -->
    <section class="py-20">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-16">
                <!-- 2023 -->
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="order-2 lg:order-1">
                        <div class="bg-slate-800/50 rounded-2xl p-8 border border-slate-700">
                            <div class="text-6xl font-black gradient-text mb-4">2023</div>
                            <p class="text-slate-400 text-lg">The year it all started</p>
                            <div class="mt-6 space-y-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 bg-amber-400 rounded-full"></div>
                                    <span class="text-slate-300">First tips shared in a group chat</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 bg-amber-400 rounded-full"></div>
                                    <span class="text-slate-300">8 close friends getting daily picks</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 bg-amber-400 rounded-full"></div>
                                    <span class="text-slate-300">62% win rate in year one</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order-1 lg:order-2">
                        <span class="text-green-400 font-semibold text-sm uppercase tracking-wider">The Beginning</span>
                        <h2 class="text-3xl font-bold mt-4 mb-6">It Started with Friends</h2>
                        <p class="text-slate-400 text-lg mb-4">
                            We've always been passionate about sports and betting. But unlike most, we actually kept detailed records of every bet. We analyzed patterns, tracked what worked, and refined our approach.
                        </p>
                        <p class="text-slate-400 text-lg">
                            Our friends noticed we were consistently winning. "Send me your picks," became the most common text we received. So we created a small group chat — just 8 people — and started sharing our daily analysis.
                        </p>
                    </div>
                </div>

                <!-- 2024 -->
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <span class="text-blue-400 font-semibold text-sm uppercase tracking-wider">Growing Organically</span>
                        <h2 class="text-3xl font-bold mt-4 mb-6">Word Spread Fast</h2>
                        <p class="text-slate-400 text-lg mb-4">
                            Friends told friends. By mid-2024, our little group chat had exploded to over 200 people. Managing it became a full-time job.
                        </p>
                        <p class="text-slate-400 text-lg">
                            We refined our methods, built tracking systems, and standardized how we presented tips. The win rate climbed to 65%. People were actually making money — and they wouldn't stop telling others.
                        </p>
                    </div>
                    <div>
                        <div class="bg-slate-800/50 rounded-2xl p-8 border border-slate-700">
                            <div class="text-6xl font-black text-blue-400 mb-4">2024</div>
                            <p class="text-slate-400 text-lg">The community grows</p>
                            <div class="mt-6 space-y-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 bg-blue-400 rounded-full"></div>
                                    <span class="text-slate-300">200+ members in our group</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 bg-blue-400 rounded-full"></div>
                                    <span class="text-slate-300">Moved to Telegram for better organization</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 bg-blue-400 rounded-full"></div>
                                    <span class="text-slate-300">65% verified win rate</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2025 -->
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="order-2 lg:order-1">
                        <div class="bg-slate-800/50 rounded-2xl p-8 border border-slate-700">
                            <div class="text-6xl font-black text-purple-400 mb-4">2025</div>
                            <p class="text-slate-400 text-lg">Preparing for launch</p>
                            <div class="mt-6 space-y-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 bg-purple-400 rounded-full"></div>
                                    <span class="text-slate-300">1,500+ requests to join</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 bg-purple-400 rounded-full"></div>
                                    <span class="text-slate-300">Built the BetsLab platform</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 bg-purple-400 rounded-full"></div>
                                    <span class="text-slate-300">67% win rate achieved</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order-1 lg:order-2">
                        <span class="text-purple-400 font-semibold text-sm uppercase tracking-wider">The Decision</span>
                        <h2 class="text-3xl font-bold mt-4 mb-6">Time to Go Big</h2>
                        <p class="text-slate-400 text-lg mb-4">
                            By 2025, we had a waiting list of over 1,500 people wanting to join. We were turning people away daily. It didn't feel right.
                        </p>
                        <p class="text-slate-400 text-lg">
                            We spent the year building BetsLab.io — a proper platform where everyone could access our tips. No more group chat chaos. No more waiting lists. Professional delivery, transparent results, and the same quality analysis that made our inner circle profitable.
                        </p>
                    </div>
                </div>

                <!-- 2026 -->
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <span class="text-amber-400 font-semibold text-sm uppercase tracking-wider">Official Launch</span>
                        <h2 class="text-3xl font-bold mt-4 mb-6">BetsLab Goes Live</h2>
                        <p class="text-slate-400 text-lg mb-4">
                            January 2026. After 3 years of proving ourselves with friends and building the perfect platform, BetsLab.io officially launched.
                        </p>
                        <p class="text-slate-400 text-lg">
                            Now everyone can access the same winning tips that helped our inner circle. Same quality. Same transparency. Same results. The only difference? You don't need to know someone to get in anymore.
                        </p>
                    </div>
                    <div>
                        <div class="bg-gradient-to-br from-amber-500/20 to-orange-500/20 rounded-2xl p-8 border border-amber-500/30">
                            <div class="text-6xl font-black gradient-text mb-4">2026</div>
                            <p class="text-amber-400 text-lg font-semibold">We're live! 🚀</p>
                            <div class="mt-6 space-y-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 bg-amber-400 rounded-full"></div>
                                    <span class="text-slate-300">BetsLab.io launches</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 bg-amber-400 rounded-full"></div>
                                    <span class="text-slate-300">Open to everyone</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 bg-amber-400 rounded-full"></div>
                                    <span class="text-slate-300">Free + VIP Telegram channels</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 bg-green-400 rounded-full"></div>
                                    <span class="text-green-400 font-semibold">67% verified win rate</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-slate-800/30">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-amber-400 font-semibold text-sm uppercase tracking-wider">By The Numbers</span>
                <h2 class="text-4xl font-bold mt-4">3 Years of Results</h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center bg-slate-800/50 rounded-2xl p-6 border border-slate-700">
                    <div class="text-4xl font-black gradient-text mb-2">3</div>
                    <div class="text-slate-400">Years of Experience</div>
                </div>
                <div class="text-center bg-slate-800/50 rounded-2xl p-6 border border-slate-700">
                    <div class="text-4xl font-black text-white mb-2">67%</div>
                    <div class="text-slate-400">Win Rate</div>
                </div>
                <div class="text-center bg-slate-800/50 rounded-2xl p-6 border border-slate-700">
                    <div class="text-4xl font-black text-white mb-2">15K+</div>
                    <div class="text-slate-400">Tips Shared</div>
                </div>
                <div class="text-center bg-slate-800/50 rounded-2xl p-6 border border-slate-700">
                    <div class="text-4xl font-black text-green-400 mb-2">+31%</div>
                    <div class="text-slate-400">Avg. Monthly ROI</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Promise -->
    <section class="py-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-amber-400 font-semibold text-sm uppercase tracking-wider">What We Stand For</span>
                <h2 class="text-4xl font-bold mt-4">Our Promise to You</h2>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center bg-slate-800/50 rounded-2xl p-8 border border-slate-700">
                    <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-orange-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-slate-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Full Transparency</h3>
                    <p class="text-slate-400">
                        Every tip is tracked publicly. We show wins AND losses. No hiding bad streaks. What you see is real.
                    </p>
                </div>

                <div class="text-center bg-slate-800/50 rounded-2xl p-8 border border-slate-700">
                    <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-orange-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-slate-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Quality Over Quantity</h3>
                    <p class="text-slate-400">
                        We don't spam you with 20 tips a day. 3-5 carefully selected picks daily. If we don't see value, we don't post.
                    </p>
                </div>

                <div class="text-center bg-slate-800/50 rounded-2xl p-8 border border-slate-700">
                    <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-orange-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-slate-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Community Spirit</h3>
                    <p class="text-slate-400">
                        We started helping friends. That spirit continues. Our Telegram community is supportive, not toxic.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-slate-800/30">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">
                3 Years of Proof.<br>
                <span class="gradient-text">Now It's Your Turn.</span>
            </h2>
            <p class="text-xl text-slate-400 mb-8 max-w-2xl mx-auto">
                We've helped friends win for 3 years. Join the community and start your own winning streak.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('register') }}" class="group bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-400 hover:to-orange-400 text-slate-900 px-8 py-4 rounded-full font-bold text-lg transition transform hover:scale-105 flex items-center space-x-2 shadow-lg shadow-amber-500/25">
                    <span>Join BetsLab Today</span>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
                <a href="{{ route('pricing') }}" class="text-slate-300 hover:text-white px-8 py-4 rounded-full font-semibold border border-slate-700 hover:border-slate-500 transition">
                    View Pricing Plans
                </a>
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
                        Sharing winning picks with friends since 2023. Now available to everyone.
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
                        <li><a href="mailto:support@betslab.io" class="hover:text-amber-400 transition">support@betslab.io</a></li>
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
