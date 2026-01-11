<?php

namespace App\Services;

use App\Events\SubscriptionActivated;
use App\Events\SubscriptionExpired;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use App\Services\Payment\NetopiaPaymentService;
use App\Services\Payment\PaymentGatewayInterface;
use App\Services\Payment\RevolutPaymentService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SubscriptionService
{
    /**
     * Create a new subscription for a user.
     */
    public function createSubscription(User $user, Plan $plan, string $gateway = 'revolut'): Subscription
    {
        return DB::transaction(function () use ($user, $plan) {
            return Subscription::create([
                'user_id' => $user->id,
                'plan_id' => $plan->id,
                'status' => 'pending',
                'price' => $plan->price,
                'starts_at' => null,
                'ends_at' => null,
            ]);
        });
    }

    /**
     * Activate a subscription after successful payment.
     */
    public function activateSubscription(Subscription $subscription): void
    {
        $plan = $subscription->plan;

        $subscription->update([
            'status' => 'active',
            'starts_at' => now(),
            'ends_at' => $plan->is_lifetime ? null : now()->addDays($plan->duration_days),
        ]);

        event(new SubscriptionActivated($subscription));
    }

    /**
     * Check and expire subscriptions.
     */
    public function expireSubscriptions(): int
    {
        $expiredSubscriptions = Subscription::expired()->get();
        $count = 0;

        foreach ($expiredSubscriptions as $subscription) {
            $subscription->markAsExpired();
            event(new SubscriptionExpired($subscription));
            $count++;
        }

        Log::info("Expired {$count} subscriptions");

        return $count;
    }

    /**
     * Get subscriptions expiring soon.
     */
    public function getExpiringSubscriptions(int $days = 3)
    {
        return Subscription::expiringSoon($days)
            ->with('user', 'plan')
            ->get();
    }

    /**
     * Initiate payment for subscription.
     */
    public function initiatePayment(Subscription $subscription, string $gateway = 'revolut'): array
    {
        $paymentService = $this->getPaymentService($gateway);

        $result = $paymentService->initiate($subscription);

        if ($result['success']) {
            // Create payment record
            Payment::create([
                'user_id' => $subscription->user_id,
                'subscription_id' => $subscription->id,
                'gateway' => $gateway,
                'transaction_id' => $result['transaction_id'],
                'amount' => $subscription->price,
                'currency' => 'RON',
                'status' => 'pending',
                'gateway_response' => $result['raw_response'] ?? null,
            ]);
        }

        return $result;
    }

    /**
     * Process payment webhook.
     */
    public function processPaymentWebhook(string $gateway, array $data): array
    {
        $paymentService = $this->getPaymentService($gateway);

        if (!$paymentService->validateWebhook($data)) {
            return [
                'success' => false,
                'error' => 'Invalid webhook signature',
            ];
        }

        $result = $paymentService->processWebhook($data);

        if (!$result['transaction_id']) {
            return [
                'success' => false,
                'error' => 'Transaction ID not found',
            ];
        }

        $payment = Payment::where('transaction_id', $result['transaction_id'])->first();

        if (!$payment) {
            // Try to find by order_id pattern
            $payment = Payment::where('transaction_id', 'LIKE', $result['order_id'] ?? 'NOT_FOUND')->first();
        }

        if (!$payment) {
            Log::warning('Payment not found for webhook', $result);
            return [
                'success' => false,
                'error' => 'Payment not found',
            ];
        }

        // Update payment status
        if ($result['status'] === 'completed') {
            $payment->markAsCompleted($result['raw_response'] ?? []);

            // Activate subscription
            if ($payment->subscription) {
                $this->activateSubscription($payment->subscription);
            }
        } elseif ($result['status'] === 'failed') {
            $payment->markAsFailed($result['raw_response'] ?? []);
        }

        return [
            'success' => true,
            'payment' => $payment,
            'status' => $result['status'],
        ];
    }

    /**
     * Get the payment service for a gateway.
     */
    private function getPaymentService(string $gateway): PaymentGatewayInterface
    {
        return match ($gateway) {
            'netopia' => app(NetopiaPaymentService::class),
            'revolut' => app(RevolutPaymentService::class),
            default => throw new \InvalidArgumentException("Unknown payment gateway: {$gateway}"),
        };
    }

    /**
     * Cancel a subscription.
     */
    public function cancelSubscription(Subscription $subscription): void
    {
        $subscription->cancel();
    }

    /**
     * Get subscription statistics.
     */
    public function getStatistics(): array
    {
        return [
            'total_subscriptions' => Subscription::count(),
            'active_subscriptions' => Subscription::active()->count(),
            'expired_subscriptions' => Subscription::where('status', 'expired')->count(),
            'total_revenue' => Payment::completed()->sum('amount'),
            'monthly_revenue' => Payment::completed()
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->sum('amount'),
        ];
    }
}

