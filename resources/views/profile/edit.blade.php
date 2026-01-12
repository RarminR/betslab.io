<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Profile Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Profile Header -->
            <div class="bg-gradient-to-r from-amber-500/20 to-orange-500/20 rounded-2xl border border-amber-500/30 p-6">
                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 bg-gradient-to-br from-amber-500 to-orange-500 rounded-full flex items-center justify-center text-slate-900 font-black text-3xl">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-white">{{ $user->name }}</h3>
                        <p class="text-slate-400">{{ $user->email }}</p>
                        <p class="text-slate-500 text-sm mt-1">Member since {{ $user->created_at->format('M Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Update Profile Information -->
            <div class="bg-slate-800/50 backdrop-blur rounded-2xl border border-slate-700 p-6">
                @include('profile.partials.update-profile-information-form')
            </div>

            <!-- Update Password -->
            <div class="bg-slate-800/50 backdrop-blur rounded-2xl border border-slate-700 p-6">
                @include('profile.partials.update-password-form')
            </div>

            <!-- Delete Account -->
            <div class="bg-slate-800/50 backdrop-blur rounded-2xl border border-red-500/30 p-6">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
