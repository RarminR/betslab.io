<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use App\Services\SubscriptionService;
use Illuminate\Http\Request;

class AdminSubscriptionController extends Controller
{
    public function __construct(
        protected SubscriptionService $subscriptionService
    ) {}

    /**
     * Display a listing of subscriptions.
     */
    public function index(Request $request)
    {
        $query = Subscription::with('user', 'plan');

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by plan
        if ($request->has('plan_id') && $request->plan_id) {
            $query->where('plan_id', $request->plan_id);
        }

        $subscriptions = $query->orderByDesc('created_at')->paginate(20);
        $plans = Plan::all();

        return view('admin.subscriptions.index', [
            'subscriptions' => $subscriptions,
            'plans' => $plans,
        ]);
    }

    /**
     * Show the form for creating a new subscription (manual).
     */
    public function create()
    {
        $users = User::orderBy('name')->get();
        $plans = Plan::active()->get();

        return view('admin.subscriptions.create', [
            'users' => $users,
            'plans' => $plans,
        ]);
    }

    /**
     * Store a newly created subscription (manual).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'plan_id' => 'required|exists:plans,id',
            'activate_now' => 'boolean',
        ]);

        $user = User::findOrFail($validated['user_id']);
        $plan = Plan::findOrFail($validated['plan_id']);

        $subscription = $this->subscriptionService->createSubscription($user, $plan);

        if ($request->boolean('activate_now')) {
            $this->subscriptionService->activateSubscription($subscription);
        }

        return redirect()->route('admin.subscriptions.index')
            ->with('success', 'Abonamentul a fost creat cu succes.');
    }

    /**
     * Display the specified subscription.
     */
    public function show(Subscription $subscription)
    {
        $subscription->load('user', 'plan', 'payments');

        return view('admin.subscriptions.show', [
            'subscription' => $subscription,
        ]);
    }

    /**
     * Show the form for editing the specified subscription.
     */
    public function edit(Subscription $subscription)
    {
        $plans = Plan::all();

        return view('admin.subscriptions.edit', [
            'subscription' => $subscription,
            'plans' => $plans,
        ]);
    }

    /**
     * Update the specified subscription.
     */
    public function update(Request $request, Subscription $subscription)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,active,expired,cancelled',
            'starts_at' => 'nullable|date',
            'ends_at' => 'nullable|date',
        ]);

        $subscription->update($validated);

        return redirect()->route('admin.subscriptions.show', $subscription)
            ->with('success', 'Abonamentul a fost actualizat cu succes.');
    }

    /**
     * Remove the specified subscription.
     */
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return redirect()->route('admin.subscriptions.index')
            ->with('success', 'Abonamentul a fost șters cu succes.');
    }

    /**
     * Activate a subscription manually.
     */
    public function activate(Subscription $subscription)
    {
        $this->subscriptionService->activateSubscription($subscription);

        return redirect()->back()
            ->with('success', 'Abonamentul a fost activat cu succes.');
    }

    /**
     * Expire a subscription manually.
     */
    public function expire(Subscription $subscription)
    {
        $subscription->markAsExpired();

        return redirect()->back()
            ->with('success', 'Abonamentul a fost marcat ca expirat.');
    }

    /**
     * Cancel a subscription.
     */
    public function cancel(Subscription $subscription)
    {
        $this->subscriptionService->cancelSubscription($subscription);

        return redirect()->back()
            ->with('success', 'Abonamentul a fost anulat.');
    }
}

