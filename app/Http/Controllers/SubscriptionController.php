<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription;
use App\Services\SubscriptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function __construct(
        protected SubscriptionService $subscriptionService
    ) {}

    /**
     * Display pricing page.
     */
    public function pricing()
    {
        $plans = Plan::active()->get();

        return view('subscription.pricing', [
            'plans' => $plans,
        ]);
    }

    /**
     * Display user's subscription.
     */
    public function index()
    {
        $user = Auth::user();
        $activeSubscription = $user->activeSubscription;
        $subscriptionHistory = $user->subscriptions()
            ->with('plan', 'payments')
            ->orderByDesc('created_at')
            ->get();

        return view('subscription.index', [
            'activeSubscription' => $activeSubscription,
            'subscriptionHistory' => $subscriptionHistory,
        ]);
    }

    /**
     * Initiate checkout for a plan.
     */
    public function checkout(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
            'gateway' => 'required|in:netopia,revolut',
        ]);

        $plan = Plan::findOrFail($request->plan_id);
        $user = Auth::user();

        // Check if user already has an active subscription
        if ($user->hasActiveSubscription()) {
            return redirect()->route('subscription.index')
                ->with('error', 'Ai deja un abonament activ.');
        }

        // Create subscription
        $subscription = $this->subscriptionService->createSubscription($user, $plan, $request->gateway);

        // Initiate payment
        $result = $this->subscriptionService->initiatePayment($subscription, $request->gateway);

        if ($result['success']) {
            // Store subscription ID in session for return handling
            session(['pending_subscription_id' => $subscription->id]);

            return redirect()->away($result['redirect_url']);
        }

        // Payment initiation failed
        $subscription->delete();

        return redirect()->route('pricing')
            ->with('error', 'A apărut o eroare la procesarea plății. Te rugăm să încerci din nou.');
    }

    /**
     * Handle payment return.
     */
    public function return(Request $request)
    {
        $subscriptionId = session('pending_subscription_id');

        if (!$subscriptionId) {
            return redirect()->route('pricing')
                ->with('error', 'Sesiunea a expirat.');
        }

        $subscription = Subscription::find($subscriptionId);

        if (!$subscription) {
            return redirect()->route('pricing')
                ->with('error', 'Abonamentul nu a fost găsit.');
        }

        // Clear session
        session()->forget('pending_subscription_id');

        // Handle simulation mode - auto-activate subscription
        if ($request->has('simulation') && $request->simulation == 1) {
            // Update any pending payment to completed
            $payment = $subscription->payments()->where('status', 'pending')->first();
            if ($payment) {
                $payment->markAsCompleted(['simulation' => true]);
            }
            
            $this->subscriptionService->activateSubscription($subscription);
            
            return redirect()->route('dashboard')
                ->with('success', '🎉 Plata simulată cu succes! Bine ai venit în BetsLab VIP!');
        }

        // Check subscription status
        if ($subscription->status === 'active') {
            return redirect()->route('dashboard')
                ->with('success', 'Plata a fost procesată cu succes! Bine ai venit în BetsLab!');
        }

        // Payment might be pending or failed
        return redirect()->route('subscription.index')
            ->with('info', 'Plata este în curs de procesare. Vei primi un email de confirmare.');
    }

    /**
     * Cancel subscription.
     */
    public function cancel(Subscription $subscription)
    {
        $user = Auth::user();

        if ($subscription->user_id !== $user->id) {
            abort(403);
        }

        if ($subscription->status !== 'active') {
            return redirect()->route('subscription.index')
                ->with('error', 'Acest abonament nu poate fi anulat.');
        }

        $this->subscriptionService->cancelSubscription($subscription);

        return redirect()->route('subscription.index')
            ->with('success', 'Abonamentul a fost anulat.');
    }
}

