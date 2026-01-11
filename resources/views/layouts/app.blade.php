<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($title) ? $title . ' - ' : '' }}{{ config('app.name', 'BetsLab') }}</title>
        <meta name="description" content="Pronosticuri sportive premium. Alătură-te comunității BetsLab și primește tips-uri câștigătoare zilnic.">

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
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Flash Messages -->
            @if (session('success'))
                <div class="bg-emerald-500/20 border border-emerald-500 text-emerald-300 px-4 py-3 mx-4 mt-4 rounded-lg max-w-7xl lg:mx-auto">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-500/20 border border-red-500 text-red-300 px-4 py-3 mx-4 mt-4 rounded-lg max-w-7xl lg:mx-auto">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('info'))
                <div class="bg-blue-500/20 border border-blue-500 text-blue-300 px-4 py-3 mx-4 mt-4 rounded-lg max-w-7xl lg:mx-auto">
                    {{ session('info') }}
                </div>
            @endif

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-slate-800/50 border-b border-slate-700">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-slate-800/50 border-t border-slate-700 mt-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <div class="text-slate-400 text-sm">
                            &copy; {{ date('Y') }} BetsLab.io. Toate drepturile rezervate.
                        </div>
                        <div class="flex space-x-6 mt-4 md:mt-0">
                            <a href="#" class="text-slate-400 hover:text-amber-400 transition">Termeni</a>
                            <a href="#" class="text-slate-400 hover:text-amber-400 transition">Confidențialitate</a>
                            <a href="#" class="text-slate-400 hover:text-amber-400 transition">Contact</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
