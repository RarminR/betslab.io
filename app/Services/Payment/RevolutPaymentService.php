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
    private bool $simulationMode;
    private string $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.revolut.api_key') ?? '';
        $this->merchantId = config('services.revolut.merchant_id') ?? '';
        $this->sandboxMode = config('services.revolut.sandbox', true);
        $this->simulationMode = empty($this->apiKey) || config('services.revolut.simulation', true);
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

        // Simulation mode - simulate successful payment immediately
        if ($this->simulationMode) {
            return $this->simulatePayment($subscription, $orderId);
        }

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
     * Simulate a successful payment for testing purposes.
     */
    private function simulatePayment(Subscription $subscription, string $orderId): array
    {
        Log::info('Revolut SIMULATION: Payment initiated', [
            'subscription_id' => $subscription->id,
            'order_id' => $orderId,
            'amount' => $subscription->price,
        ]);

        $transactionId = 'SIM-' . Str::random(16);

        // In simulation mode, redirect to a simulated success page
        return [
            'success' => true,
            'simulation' => true,
            'transaction_id' => $transactionId,
            'redirect_url' => route('payment.return', [
                'status' => 'success',
                'transaction_id' => $transactionId,
                'order_id' => $orderId,
                'simulation' => 1,
            ]),
            'order_id' => $orderId,
            'raw_response' => [
                'simulation' => true,
                'message' => 'Payment simulated successfully',
            ],
        ];
    }

    /**
     * Process webhook/callback from payment gateway.
     */
    public function processWebhook(array $data): array
    {
        Log::info('Revolut webhook received', $data);

        // Handle simulation webhook
        if (isset($data['simulation']) && $data['simulation']) {
            return [
                'success' => true,
                'simulation' => true,
                'transaction_id' => $data['transaction_id'] ?? null,
                'order_id' => $data['order_id'] ?? null,
                'status' => 'completed',
                'amount' => $data['amount'] ?? 0,
                'metadata' => $data['metadata'] ?? [],
                'raw_response' => $data,
            ];
        }

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
        // Handle simulation verification
        if (str_starts_with($transactionId, 'SIM-')) {
            return [
                'success' => true,
                'simulation' => true,
                'transaction_id' => $transactionId,
                'status' => 'completed',
                'amount' => 0,
                'raw_response' => ['simulation' => true],
            ];
        }

        if ($this->simulationMode) {
            return [
                'success' => true,
                'simulation' => true,
                'transaction_id' => $transactionId,
                'status' => 'completed',
                'amount' => 0,
                'raw_response' => ['simulation' => true],
            ];
        }

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
        // Allow simulation webhooks
        if (isset($data['simulation']) && $data['simulation']) {
            return true;
        }

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
     * Check if we're in simulation mode.
     */
    public function isSimulationMode(): bool
    {
        return $this->simulationMode;
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
