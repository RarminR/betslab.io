<?php

namespace App\Http\Controllers;

use App\Services\SubscriptionService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class PaymentWebhookController extends Controller
{
    public function __construct(
        protected SubscriptionService $subscriptionService
    ) {}

    /**
     * Handle Netopia webhook.
     */
    public function netopia(Request $request): Response
    {
        Log::info('Netopia webhook received', $request->all());

        try {
            $result = $this->subscriptionService->processPaymentWebhook('netopia', $request->all());

            if ($result['success']) {
                // Return Netopia-specific success response
                return response($this->buildNetopiaResponse('confirmed'), 200)
                    ->header('Content-Type', 'application/xml');
            }

            Log::warning('Netopia webhook processing failed', $result);

            return response($this->buildNetopiaResponse('confirmed'), 200)
                ->header('Content-Type', 'application/xml');
        } catch (\Exception $e) {
            Log::error('Netopia webhook exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response($this->buildNetopiaResponse('confirmed'), 200)
                ->header('Content-Type', 'application/xml');
        }
    }

    /**
     * Handle Revolut webhook.
     */
    public function revolut(Request $request): Response
    {
        Log::info('Revolut webhook received', $request->all());

        try {
            $result = $this->subscriptionService->processPaymentWebhook('revolut', $request->all());

            if ($result['success']) {
                return response()->json(['status' => 'ok'], 200);
            }

            Log::warning('Revolut webhook processing failed', $result);

            return response()->json(['status' => 'ok'], 200);
        } catch (\Exception $e) {
            Log::error('Revolut webhook exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json(['status' => 'error'], 500);
        }
    }

    /**
     * Build Netopia XML response.
     */
    private function buildNetopiaResponse(string $action, string $errorMessage = ''): string
    {
        $errorCode = $action === 'confirmed' ? 0 : 1;
        
        return <<<XML
<?xml version="1.0" encoding="utf-8"?>
<crc error_code="{$errorCode}">{$errorMessage}</crc>
XML;
    }
}

