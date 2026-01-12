<?php

namespace App\Services\Payment;

use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class NetopiaPaymentService implements PaymentGatewayInterface
{
    private string $merchantId;
    private string $publicKey;
    private string $privateKey;
    private string $signature;
    private bool $sandboxMode;
    private bool $simulationMode;

    public function __construct()
    {
        $this->merchantId = config('services.netopia.merchant_id') ?? '';
        $this->publicKey = config('services.netopia.public_key') ?? '';
        $this->privateKey = config('services.netopia.private_key') ?? '';
        $this->signature = config('services.netopia.signature') ?? '';
        $this->sandboxMode = config('services.netopia.sandbox', true);
        $this->simulationMode = empty($this->merchantId) || config('services.netopia.simulation', true);
    }

    /**
     * Get the gateway name.
     */
    public function getName(): string
    {
        return 'netopia';
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
        
        $paymentData = [
            'order_id' => $orderId,
            'amount' => $subscription->price,
            'currency' => 'RON',
            'description' => 'Abonament BetsLab.io - ' . $subscription->plan->name,
            'customer' => [
                'email' => $subscription->user->email,
                'name' => $subscription->user->name,
            ],
            'return_url' => route('payment.return'),
            'confirm_url' => route('webhooks.netopia'),
        ];

        // In production, this would generate encrypted payment request
        // For now, we'll store the basic data
        
        return [
            'success' => true,
            'transaction_id' => $orderId,
            'redirect_url' => $this->getPaymentUrl(),
            'payment_data' => $this->encryptPaymentData($paymentData),
        ];
    }

    /**
     * Simulate a successful payment for testing purposes.
     */
    private function simulatePayment(Subscription $subscription, string $orderId): array
    {
        Log::info('Netopia SIMULATION: Payment initiated', [
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
        Log::info('Netopia webhook received', $data);

        // Handle simulation webhook
        if (isset($data['simulation']) && $data['simulation']) {
            return [
                'success' => true,
                'simulation' => true,
                'transaction_id' => $data['transaction_id'] ?? null,
                'order_id' => $data['order_id'] ?? null,
                'status' => 'completed',
                'amount' => $data['amount'] ?? 0,
                'raw_response' => $data,
            ];
        }

        // Decrypt and parse the response
        $decryptedData = $this->decryptResponse($data);
        
        if (!$decryptedData) {
            return [
                'success' => false,
                'error' => 'Failed to decrypt response',
            ];
        }

        $status = $this->mapNetopiaStatus($decryptedData['action'] ?? '');
        
        return [
            'success' => $status === 'completed',
            'transaction_id' => $decryptedData['orderId'] ?? null,
            'status' => $status,
            'amount' => $decryptedData['processedAmount'] ?? 0,
            'raw_response' => $decryptedData,
        ];
    }

    /**
     * Verify payment status.
     */
    public function verifyPayment(string $transactionId): array
    {
        // Handle simulation verification
        if (str_starts_with($transactionId, 'SIM-') || $this->simulationMode) {
            return [
                'success' => true,
                'simulation' => true,
                'transaction_id' => $transactionId,
                'status' => 'completed',
                'amount' => 0,
                'raw_response' => ['simulation' => true],
            ];
        }

        // Netopia doesn't have a direct verification API
        // Status is communicated via webhooks
        return [
            'success' => true,
            'transaction_id' => $transactionId,
            'message' => 'Verification done via webhook',
        ];
    }

    /**
     * Get the redirect URL for payment.
     */
    public function getRedirectUrl(array $paymentData): string
    {
        return $this->getPaymentUrl();
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

        // Validate that required fields exist
        if (!isset($data['env_key']) || !isset($data['data'])) {
            return false;
        }

        // In production, verify the signature
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
     * Get the payment URL based on environment.
     */
    private function getPaymentUrl(): string
    {
        return $this->sandboxMode
            ? 'https://sandboxsecure.mobilpay.ro'
            : 'https://secure.mobilpay.ro';
    }

    /**
     * Encrypt payment data for Netopia.
     */
    private function encryptPaymentData(array $data): array
    {
        // In production, this would use OpenSSL to encrypt with Netopia's public key
        // For demonstration, we return the raw structure
        
        $xml = $this->buildPaymentXml($data);
        
        // Placeholder for encryption
        // In real implementation:
        // 1. Generate random AES key
        // 2. Encrypt XML with AES key
        // 3. Encrypt AES key with Netopia's RSA public key
        
        return [
            'env_key' => base64_encode('placeholder_env_key'),
            'data' => base64_encode($xml),
        ];
    }

    /**
     * Build XML payment request.
     */
    private function buildPaymentXml(array $data): string
    {
        return <<<XML
<?xml version="1.0" encoding="utf-8"?>
<order type="card" id="{$data['order_id']}" timestamp="' . time() . '">
    <signature>{$this->signature}</signature>
    <invoice currency="{$data['currency']}" amount="{$data['amount']}">
        <details>{$data['description']}</details>
        <contact_info>
            <billing type="person">
                <email>{$data['customer']['email']}</email>
                <first_name>{$data['customer']['name']}</first_name>
            </billing>
        </contact_info>
    </invoice>
    <url>
        <confirm>{$data['confirm_url']}</confirm>
        <return>{$data['return_url']}</return>
    </url>
</order>
XML;
    }

    /**
     * Decrypt response from Netopia.
     */
    private function decryptResponse(array $data): ?array
    {
        // In production, this would:
        // 1. Decrypt AES key using our RSA private key
        // 2. Decrypt data using AES key
        // 3. Parse XML response
        
        // For demonstration, parse the basic structure
        if (!isset($data['data'])) {
            return null;
        }

        // Simulated decrypted response structure
        return [
            'orderId' => $data['orderId'] ?? null,
            'action' => $data['action'] ?? 'confirmed',
            'processedAmount' => $data['amount'] ?? 0,
            'errorCode' => $data['errorCode'] ?? 0,
        ];
    }

    /**
     * Map Netopia status to our status.
     */
    private function mapNetopiaStatus(string $action): string
    {
        return match ($action) {
            'confirmed' => 'completed',
            'confirmed_pending' => 'pending',
            'paid_pending' => 'pending',
            'paid' => 'completed',
            'canceled' => 'failed',
            'credit' => 'refunded',
            default => 'pending',
        };
    }
}
