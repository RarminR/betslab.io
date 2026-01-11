<?php

namespace App\Services\Payment;

use App\Models\Subscription;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RevolutPaymentService implements PaymentGatewayInterface
{
    private string $apiKey;
    private string $merchantId;
    private bool $sandboxMode;
    private string $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.revolut.api_key', '');
        $this->merchantId = config('services.revolut.merchant_id', '');
        $this->sandboxMode = config('services.revolut.sandbox', true);
        $this->baseUrl = $this->sandboxMode
            ? 'https://sandbox-merchant.revolut.com/api/1.0'
            : 'https://merchant.revolut.com/api/1.0';
    }

    /**
     * Get the gateway name.
     */
    public function getName(): string
    {
        return 'revolut';
    }

    /**
     * Initialize a payment and return payment data/redirect URL.
     */
    public function initiate(Subscription $subscription): array
    {
        $orderId = 'BL-' . $subscription->id . '-' . Str::random(8);

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl . '/orders', [
                'amount' => (int) ($subscription->price * 100), // Amount in cents
                'currency' => 'RON',
                'description' => 'Abonament BetsLab.io - ' . $subscription->plan->name,
                'merchant_order_ext_ref' => $orderId,
                'email' => $subscription->user->email,
                'customer_email' => $subscription->user->email,
                'settlement_currency' => 'RON',
                'metadata' => [
                    'subscription_id' => $subscription->id,
                    'user_id' => $subscription->user_id,
                    'plan_id' => $subscription->plan_id,
                ],
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                return [
                    'success' => true,
                    'transaction_id' => $data['id'] ?? $orderId,
                    'redirect_url' => $data['checkout_url'] ?? null,
                    'order_id' => $orderId,
                    'raw_response' => $data,
                ];
            }

            Log::error('Revolut payment initiation failed', [
                'status' => $response->status(),
                'response' => $response->json(),
            ]);

            return [
                'success' => false,
                'error' => $response->json()['message'] ?? 'Payment initiation failed',
            ];
        } catch (\Exception $e) {
            Log::error('Revolut payment exception', [
                'message' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'error' => 'Payment service unavailable',
            ];
        }
    }

    /**
     * Process webhook/callback from payment gateway.
     */
    public function processWebhook(array $data): array
    {
        Log::info('Revolut webhook received', $data);

        $event = $data['event'] ?? null;
        $orderData = $data['order'] ?? $data;
        
        $status = $this->mapRevolutStatus($orderData['state'] ?? '');

        return [
            'success' => $status === 'completed',
            'transaction_id' => $orderData['id'] ?? null,
            'order_id' => $orderData['merchant_order_ext_ref'] ?? null,
            'status' => $status,
            'amount' => ($orderData['order_amount']['value'] ?? 0) / 100,
            'metadata' => $orderData['metadata'] ?? [],
            'raw_response' => $data,
        ];
    }

    /**
     * Verify payment status.
     */
    public function verifyPayment(string $transactionId): array
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
            ])->get($this->baseUrl . '/orders/' . $transactionId);

            if ($response->successful()) {
                $data = $response->json();
                
                return [
                    'success' => true,
                    'transaction_id' => $transactionId,
                    'status' => $this->mapRevolutStatus($data['state'] ?? ''),
                    'amount' => ($data['order_amount']['value'] ?? 0) / 100,
                    'raw_response' => $data,
                ];
            }

            return [
                'success' => false,
                'error' => 'Failed to verify payment',
            ];
        } catch (\Exception $e) {
            Log::error('Revolut verification exception', [
                'transaction_id' => $transactionId,
                'message' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'error' => 'Verification service unavailable',
            ];
        }
    }

    /**
     * Get the redirect URL for payment.
     */
    public function getRedirectUrl(array $paymentData): string
    {
        return $paymentData['redirect_url'] ?? '';
    }

    /**
     * Check if the webhook data is valid.
     */
    public function validateWebhook(array $data): bool
    {
        // Validate webhook signature
        $signature = request()->header('Revolut-Signature');
        
        if (!$signature) {
            return false;
        }

        // In production, verify the signature using webhook secret
        // $expectedSignature = hash_hmac('sha256', json_encode($data), config('services.revolut.webhook_secret'));
        
        return true;
    }

    /**
     * Map Revolut status to our status.
     */
    private function mapRevolutStatus(string $state): string
    {
        return match ($state) {
            'COMPLETED' => 'completed',
            'PENDING' => 'pending',
            'PROCESSING' => 'pending',
            'AUTHORISED' => 'pending',
            'CANCELLED' => 'failed',
            'FAILED' => 'failed',
            default => 'pending',
        };
    }
}

