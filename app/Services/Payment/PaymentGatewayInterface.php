<?php

namespace App\Services\Payment;

use App\Models\Payment;
use App\Models\Subscription;

interface PaymentGatewayInterface
{
    /**
     * Get the gateway name.
     */
    public function getName(): string;

    /**
     * Initialize a payment and return payment data/redirect URL.
     */
    public function initiate(Subscription $subscription): array;

    /**
     * Process webhook/callback from payment gateway.
     */
    public function processWebhook(array $data): array;

    /**
     * Verify payment status.
     */
    public function verifyPayment(string $transactionId): array;

    /**
     * Get the redirect URL for payment.
     */
    public function getRedirectUrl(array $paymentData): string;

    /**
     * Check if the webhook data is valid.
     */
    public function validateWebhook(array $data): bool;
}

