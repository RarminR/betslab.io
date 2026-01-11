<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index(Request $request)
    {
        $query = User::with('activeSubscription.plan');

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by subscription status
        if ($request->has('subscription') && $request->subscription === 'active') {
            $query->withActiveSubscription();
        }

        $users = $query->orderByDesc('created_at')->paginate(20);

        return view('admin.users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        $user->load([
            'subscriptions.plan',
            'subscriptions.payments',
            'payments',
        ]);

        return view('admin.users.show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified user.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'telegram_username' => 'nullable|string|max:100',
            'is_admin' => 'boolean',
        ]);

        $user->update($validated);

        return redirect()->route('admin.users.show', $user)
            ->with('success', 'Utilizatorul a fost actualizat cu succes.');
    }

    /**
     * Remove the specified user.
     */
    public function destroy(User $user)
    {
        if ($user->is_admin) {
            return redirect()->back()
                ->with('error', 'Nu poți șterge un administrator.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilizatorul a fost șters cu succes.');
    }

    /**
     * Toggle admin status.
     */
    public function toggleAdmin(User $user)
    {
        $user->update(['is_admin' => !$user->is_admin]);

        $status = $user->is_admin ? 'promovat ca administrator' : 'revocat din rol de administrator';

        return redirect()->back()
            ->with('success', "Utilizatorul a fost {$status}.");
    }
}

