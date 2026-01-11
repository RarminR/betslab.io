<?php

namespace App\Listeners;

use App\Events\TipPublished;
use App\Services\TelegramService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class SendTipToTelegram implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct(
        protected TelegramService $telegramService
    ) {}

    /**
     * Handle the event.
     */
    public function handle(TipPublished $event): void
    {
        $tip = $event->tip;
        
        if (!$this->telegramService->isConfigured()) {
            Log::warning("Telegram bot not configured. Skipping tip {$tip->id} send.");
            return;
        }

        // Send to the appropriate channel based on tip's channel_type
        if ($tip->isFree()) {
            // Free tips go to the free channel
            if ($this->telegramService->isChannelConfigured('free')) {
                $result = $this->telegramService->sendTipToFreeChannel($tip);
                Log::info("Free tip {$tip->id} sent to free channel", $result);
            } else {
                Log::warning("Free channel not configured. Skipping free tip {$tip->id}.");
            }
        } else {
            // VIP tips go to the VIP channel
            if ($this->telegramService->isChannelConfigured('vip')) {
                $result = $this->telegramService->sendTipToVipChannel($tip);
                Log::info("VIP tip {$tip->id} sent to VIP channel", $result);
            } else {
                Log::warning("VIP channel not configured. Skipping VIP tip {$tip->id}.");
            }
        }
    }
}
