<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Create Account - {{ config('app.name', 'BetsLab.io') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=space-grotesk:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Space Grotesk', sans-serif; }
        .gradient-text {
            background: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .glow-border:focus {
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.3);
        }
    </style>
</head>
<body class="antialiased bg-slate-900 text-white min-h-screen">
    <!-- Background Pattern -->
    <div class="fixed inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23334155\" fill-opacity=\"0.1\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-50 pointer-events-none"></div>

    <!-- Gradient Orbs -->
    <div class="fixed top-0 right-0 w-96 h-96 bg-amber-500/20 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
    <div class="fixed bottom-0 left-0 w-96 h-96 bg-orange-500/20 rounded-full blur-3xl -translate-x-1/2 translate-y-1/2 pointer-events-none"></div>

    <div class="min-h-screen flex">
        <!-- Left Panel - Registration Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 relative z-10">
            <div class="w-full max-w-md">
                <!-- Mobile Logo -->
                <div class="lg:hidden text-center mb-8">
                    <a href="{{ route('home') }}" class="inline-block">
                        <div class="text-3xl font-black">
                            <span class="gradient-text">Bets</span><span class="text-white">Lab</span><span class="text-amber-400">.io</span>
                        </div>
                    </a>
                </div>

                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold mb-2">Join BetsLab</h1>
                    <p class="text-slate-400">Start winning with data-driven betting tips</p>
                </div>

                <!-- Registration Form -->
                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-300 mb-2">Full Name</label>
                        <input 
                            id="name" 
                            type="text" 
                            name="name" 
                            value="{{ old('name') }}"
                            required 
                            autofocus 
                            autocomplete="name"
                            class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 glow-border transition"
                            placeholder="John Doe"
                        >
                        @error('name')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-300 mb-2">Email Address</label>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            required 
                            autocomplete="username"
                            class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 glow-border transition"
                            placeholder="you@example.com"
                        >
                        @error('email')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-300 mb-2">Password</label>
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="new-password"
                            class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 glow-border transition"
                            placeholder="••••••••"
                        >
                        @error('password')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-xs text-slate-500">Must be at least 8 characters</p>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-300 mb-2">Confirm Password</label>
                        <input 
                            id="password_confirmation" 
                            type="password" 
                            name="password_confirmation" 
                            required 
                            autocomplete="new-password"
                            class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 glow-border transition"
                            placeholder="••••••••"
                        >
                        @error('password_confirmation')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- What You Get -->
                    <div class="bg-slate-800/50 rounded-xl p-4 border border-slate-700">
                        <p class="text-sm font-medium text-white mb-3">What you'll get:</p>
                        <div class="space-y-2">
                            <div class="flex items-center gap-2 text-sm text-slate-400">
                                <svg class="w-4 h-4 text-green-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span>Access to free tips & Telegram channel</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-slate-400">
                                <svg class="w-4 h-4 text-green-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span>Personal dashboard with tip history</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-slate-400">
                                <svg class="w-4 h-4 text-amber-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                <span>Upgrade anytime for VIP premium tips</span>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit"
                        class="w-full py-4 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-400 hover:to-orange-400 text-slate-900 font-bold rounded-xl transition transform hover:scale-[1.02] active:scale-[0.98]"
                    >
                        Create Account
                    </button>

                    <!-- Terms -->
                    <p class="text-xs text-slate-500 text-center">
                        By creating an account, you agree to our 
                        <a href="#" class="text-amber-400 hover:underline">Terms of Service</a> 
                        and 
                        <a href="#" class="text-amber-400 hover:underline">Privacy Policy</a>
                    </p>
                </form>

                <!-- Divider -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-700"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-slate-900 text-slate-500">Already have an account?</span>
                    </div>
                </div>

                <!-- Sign In Link -->
                <a 
                    href="{{ route('login') }}"
                    class="block w-full py-4 bg-slate-800 hover:bg-slate-700 border border-slate-700 text-white font-semibold rounded-xl text-center transition"
                >
                    Sign In
                </a>

                <!-- Back to Home -->
                <div class="text-center mt-8">
                    <a href="{{ route('home') }}" class="text-slate-500 hover:text-slate-300 text-sm transition">
                        ← Back to Homepage
                    </a>
                </div>
            </div>
        </div>

        <!-- Right Panel - Branding -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-gradient-to-bl from-slate-800 to-slate-900 items-center justify-center">
            <div class="absolute inset-0 bg-gradient-to-bl from-amber-500/10 to-orange-500/10"></div>
            <div class="relative z-10 flex flex-col items-center p-12 text-center">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="mb-8">
                    <div class="text-5xl font-black">
                        <span class="gradient-text">Bets</span><span class="text-white">Lab</span><span class="text-amber-400">.io</span>
                    </div>
                </a>

                <h2 class="text-3xl font-bold mb-4">Win More. Bet Smarter.</h2>
                <p class="text-slate-400 max-w-md mb-12">
                    Join thousands of successful bettors who trust our data-driven approach to sports betting.
                </p>
                
                <!-- Stats Cards -->
                <div class="grid grid-cols-2 gap-4 w-full max-w-sm mb-12">
                    <div class="bg-slate-800/50 backdrop-blur rounded-xl p-4 border border-slate-700">
                        <div class="text-3xl font-black text-green-400 mb-1">67%</div>
                        <div class="text-slate-400 text-sm">Win Rate</div>
                    </div>
                    <div class="bg-slate-800/50 backdrop-blur rounded-xl p-4 border border-slate-700">
                        <div class="text-3xl font-black text-white mb-1">3-5</div>
                        <div class="text-slate-400 text-sm">Daily Tips</div>
                    </div>
                    <div class="bg-slate-800/50 backdrop-blur rounded-xl p-4 border border-slate-700">
                        <div class="text-3xl font-black text-amber-400 mb-1">2,847+</div>
                        <div class="text-slate-400 text-sm">Active Members</div>
                    </div>
                    <div class="bg-slate-800/50 backdrop-blur rounded-xl p-4 border border-slate-700">
                        <div class="text-3xl font-black text-blue-400 mb-1">3 Years</div>
                        <div class="text-slate-400 text-sm">Proven Track Record</div>
                    </div>
                </div>

                <!-- Trust Badges -->
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-2 text-slate-400 text-sm">
                        <svg class="w-5 h-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <span>Secure & Private</span>
                    </div>
                    <div class="flex items-center gap-2 text-slate-400 text-sm">
                        <svg class="w-5 h-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Instant Access</span>
                    </div>
                </div>

                <!-- Telegram Icon -->
                <div class="mt-12 flex items-center gap-3 bg-blue-500/20 px-6 py-3 rounded-full border border-blue-500/30">
                    <svg class="w-6 h-6 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                    </svg>
                    <span class="text-blue-400 font-medium">Tips delivered via Telegram</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
