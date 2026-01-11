<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">Utilizatori</h2>
    </x-slot>

    <!-- Search -->
    <div class="mb-6">
        <form method="GET" class="flex items-center space-x-4">
            <input type="text" name="search" value="{{ request('search') }}" 
                placeholder="Caută după nume sau email..."
                class="flex-1 max-w-md bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-white focus:border-amber-400 focus:outline-none">
            <select name="subscription" onchange="this.form.submit()" class="bg-slate-800 border border-slate-700 text-white rounded-lg px-4 py-2">
                <option value="">Toți utilizatorii</option>
                <option value="active" {{ request('subscription') === 'active' ? 'selected' : '' }}>Cu abonament activ</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-amber-400 text-slate-900 rounded-lg font-semibold hover:bg-amber-500 transition">
                Caută
            </button>
        </form>
    </div>

    <!-- Users Table -->
    <div class="bg-slate-800/50 rounded-xl border border-slate-700 overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-800">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-400 uppercase">Utilizator</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-400 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-400 uppercase">Abonament</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-400 uppercase">Rol</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-400 uppercase">Înregistrat</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-slate-400 uppercase">Acțiuni</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700">
                @forelse($users as $user)
                <tr class="hover:bg-slate-800/50">
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.users.show', $user) }}" class="text-white font-medium hover:text-amber-400">
                            {{ $user->name }}
                        </a>
                    </td>
                    <td class="px-6 py-4 text-slate-300">{{ $user->email }}</td>
                    <td class="px-6 py-4">
                        @if($user->activeSubscription)
                        <span class="px-2 py-1 bg-emerald-500/20 text-emerald-400 rounded text-xs font-semibold">
                            {{ $user->activeSubscription->plan->name }}
                        </span>
                        @else
                        <span class="text-slate-500">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @if($user->is_admin)
                        <span class="px-2 py-1 bg-red-500/20 text-red-400 rounded text-xs font-semibold">Admin</span>
                        @else
                        <span class="text-slate-400 text-sm">User</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-slate-400 text-sm">{{ $user->created_at->format('d.m.Y') }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.users.show', $user) }}" class="text-slate-400 hover:text-white">
                            <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-slate-400">
                        Niciun utilizator găsit.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $users->links() }}
    </div>
</x-admin-layout>

