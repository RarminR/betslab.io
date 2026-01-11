<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($title) ? $title . ' - ' : '' }}Admin - {{ config('app.name', 'BetsLab') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Outfit', sans-serif; }
        </style>
    </head>
    <body class="font-sans antialiased bg-slate-900 text-white">
        <div class="min-h-screen flex">
            <!-- Sidebar -->
            <aside class="w-64 bg-slate-800 border-r border-slate-700 flex flex-col">
                <!-- Logo -->
                <div class="p-6 border-b border-slate-700">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
                        <span class="text-2xl font-bold bg-gradient-to-r from-amber-400 to-orange-500 bg-clip-text text-transparent">BetsLab</span>
                        <span class="text-xs bg-red-500 text-white px-2 py-0.5 rounded-full font-semibold">ADMIN</span>
                    </a>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 p-4 space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-amber-400/10 text-amber-400' : 'text-slate-300 hover:bg-slate-700' }} transition">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.tips.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.tips.*') ? 'bg-amber-400/10 text-amber-400' : 'text-slate-300 hover:bg-slate-700' }} transition">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Pronosticuri
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-amber-400/10 text-amber-400' : 'text-slate-300 hover:bg-slate-700' }} transition">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        Utilizatori
                    </a>
                    <a href="{{ route('admin.subscriptions.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.subscriptions.*') ? 'bg-amber-400/10 text-amber-400' : 'text-slate-300 hover:bg-slate-700' }} transition">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        Abonamente
                    </a>
                </nav>

                <!-- User Info -->
                <div class="p-4 border-t border-slate-700">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full bg-amber-400/20 flex items-center justify-center">
                                <span class="text-amber-400 font-semibold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-white">{{ auth()->user()->name }}</div>
                                <div class="text-xs text-slate-400">Admin</div>
                            </div>
                        </div>
                        <a href="{{ route('home') }}" class="text-slate-400 hover:text-white" title="Înapoi la site">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col">
                <!-- Top Bar -->
                <header class="bg-slate-800/50 border-b border-slate-700 px-6 py-4">
                    <div class="flex items-center justify-between">
                        @isset($header)
                        <div>{{ $header }}</div>
                        @endisset

                        <!-- Flash Messages -->
                        @if (session('success'))
                        <div class="bg-emerald-500/20 border border-emerald-500 text-emerald-300 px-4 py-2 rounded-lg text-sm">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if (session('error'))
                        <div class="bg-red-500/20 border border-red-500 text-red-300 px-4 py-2 rounded-lg text-sm">
                            {{ session('error') }}
                        </div>
                        @endif
                    </div>
                </header>

                <!-- Content -->
                <main class="flex-1 p-6 overflow-auto">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>

