<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - {{ config('app.name', 'BetsLab.io') }}</title>
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
    <div class="fixed top-0 left-0 w-96 h-96 bg-amber-500/20 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
    <div class="fixed bottom-0 right-0 w-96 h-96 bg-orange-500/20 rounded-full blur-3xl translate-x-1/2 translate-y-1/2 pointer-events-none"></div>

    <div class="min-h-screen flex">
        <!-- Left Panel - Branding -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-gradient-to-br from-slate-800 to-slate-900 items-center justify-center">
            <div class="absolute inset-0 bg-gradient-to-br from-amber-500/10 to-orange-500/10"></div>
            <div class="relative z-10 flex flex-col items-center p-12 text-center">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="mb-8">
                    <div class="text-5xl font-black">
                        <span class="gradient-text">Bets</span><span class="text-white">Lab</span><span class="text-amber-400">.io</span>
                    </div>
                </a>
                
                <!-- Stats -->
                <div class="grid grid-cols-3 gap-8 mb-12">
                    <div class="text-center">
                        <div class="text-4xl font-black text-green-400">67%</div>
                        <div class="text-slate-400 text-sm">Win Rate</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-black text-white">2,847+</div>
                        <div class="text-slate-400 text-sm">Members</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-black text-amber-400">15K+</div>
                        <div class="text-slate-400 text-sm">Tips Sent</div>
                    </div>
                </div>

                <!-- Testimonial -->
                <div class="max-w-md bg-slate-800/50 backdrop-blur rounded-2xl p-6 border border-slate-700">
                    <div class="flex items-center gap-1 mb-3">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                    <p class="text-slate-300 italic mb-4">
                        "BetsLab transformed my betting game. Their analysis is spot-on and I've been profitable every month since joining."
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-orange-500 rounded-full flex items-center justify-center text-slate-900 font-bold">
                            M
                        </div>
                        <div>
                            <div class="text-white font-semibold">Mihai R.</div>
                            <div class="text-slate-500 text-sm">VIP Member since 2024</div>
                        </div>
                    </div>
                </div>

                <!-- Features -->
                <div class="mt-12 flex items-center gap-8 text-slate-400 text-sm">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>3-5 Daily Tips</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>VIP Telegram</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>Full Analysis</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Panel - Login Form -->
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
                    <h1 class="text-3xl font-bold mb-2">Welcome Back!</h1>
                    <p class="text-slate-400">Sign in to access your premium tips</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4 bg-green-500/20 border border-green-500/50 text-green-400 px-4 py-3 rounded-xl" :status="session('status')" />

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-300 mb-2">Email Address</label>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            required 
                            autofocus 
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
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-sm font-medium text-slate-300">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm text-amber-400 hover:text-amber-300 transition">
                                    Forgot password?
                                </a>
                            @endif
                        </div>
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="current-password"
                            class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 glow-border transition"
                            placeholder="••••••••"
                        >
                        @error('password')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input 
                            id="remember_me" 
                            type="checkbox" 
                            name="remember"
                            class="w-4 h-4 rounded border-slate-600 bg-slate-800 text-amber-500 focus:ring-amber-500 focus:ring-offset-slate-900"
                        >
                        <label for="remember_me" class="ml-2 text-sm text-slate-400">
                            Remember me
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit"
                        class="w-full py-4 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-400 hover:to-orange-400 text-slate-900 font-bold rounded-xl transition transform hover:scale-[1.02] active:scale-[0.98]"
                    >
                        Sign In
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-700"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-slate-900 text-slate-500">New to BetsLab?</span>
                    </div>
                </div>

                <!-- Sign Up Link -->
                <a 
                    href="{{ route('register') }}"
                    class="block w-full py-4 bg-slate-800 hover:bg-slate-700 border border-slate-700 text-white font-semibold rounded-xl text-center transition"
                >
                    Create an Account
                </a>

                <!-- Back to Home -->
                <div class="text-center mt-8">
                    <a href="{{ route('home') }}" class="text-slate-500 hover:text-slate-300 text-sm transition">
                        ← Back to Homepage
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
