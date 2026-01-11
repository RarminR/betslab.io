<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.subscriptions.index') }}" class="text-slate-400 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-white">Abonament Manual</h2>
        </div>
    </x-slot>

    <form action="{{ route('admin.subscriptions.store') }}" method="POST" class="max-w-xl">
        @csrf

        <div class="bg-slate-800/50 rounded-xl border border-slate-700 p-6 space-y-4">
            <div>
                <label class="block text-slate-400 text-sm mb-2">Utilizator</label>
                <select name="user_id" required class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-white focus:border-amber-400 focus:outline-none">
                    <option value="">Selectează utilizatorul</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
                @error('user_id') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-slate-400 text-sm mb-2">Plan</label>
                <select name="plan_id" required class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-white focus:border-amber-400 focus:outline-none">
                    <option value="">Selectează planul</option>
                    @foreach($plans as $plan)
                    <option value="{{ $plan->id }}">{{ $plan->name }} - {{ number_format($plan->price, 2) }} RON</option>
                    @endforeach
                </select>
                @error('plan_id') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="flex items-center space-x-3">
                    <input type="checkbox" name="activate_now" value="1" checked
                        class="w-5 h-5 rounded border-slate-600 bg-slate-800 text-amber-400 focus:ring-amber-400">
                    <span class="text-white">Activează imediat</span>
                </label>
                <p class="text-slate-400 text-sm mt-1 ml-8">Dacă este bifat, abonamentul va fi activat fără plată.</p>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end space-x-4">
            <a href="{{ route('admin.subscriptions.index') }}" class="px-6 py-3 bg-slate-700 text-white rounded-lg hover:bg-slate-600 transition">
                Anulează
            </a>
            <button type="submit" class="px-6 py-3 bg-amber-400 text-slate-900 rounded-lg font-semibold hover:bg-amber-500 transition">
                Creează Abonament
            </button>
        </div>
    </form>
</x-admin-layout>

