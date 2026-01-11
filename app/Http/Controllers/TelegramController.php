<?php

namespace App\Http\Controllers;

use App\Services\TelegramService;
use Illuminate\Support\Facades\Auth;

class TelegramController extends Controller
{
    public function __construct(
        protected TelegramService $telegramService
    ) {}

    /**
     * Display Free Telegram channel access page.
     * Available to all registered users.
     */
    public function free()
    {
        return view('telegram.free', [
            'inviteLink' => $this->telegramService->getInviteLink('free'),
            'channelName' => $this->telegramService->getChannelName('free'),
            'channelDescription' => $this->telegramService->getChannelDescription('free'),
            'isConfigured' => $this->telegramService->isChannelConfigured('free'),
        ]);
    }

    /**
     * Display VIP Telegram channel access page.
     * Only available to active subscribers.
     */
    public function vip()
    {
        $user = Auth::user();

        if (!$user->hasActiveSubscription()) {
            return redirect()->route('pricing')
                ->with('error', 'You need an active subscription to access the VIP Telegram channel.');
        }

        return view('telegram.vip', [
            'inviteLink' => $this->telegramService->getInviteLink('vip'),
            'channelName' => $this->telegramService->getChannelName('vip'),
            'channelDescription' => $this->telegramService->getChannelDescription('vip'),
            'isConfigured' => $this->telegramService->isChannelConfigured('vip'),
        ]);
    }

    /**
     * Display combined Telegram access page showing both channels.
     */
    public function access()
    {
        $user = Auth::user();
        $hasSubscription = $user->hasActiveSubscription();

        return view('telegram.access', [
            'hasSubscription' => $hasSubscription,
            'freeChannel' => [
                'inviteLink' => $this->telegramService->getInviteLink('free'),
                'name' => $this->telegramService->getChannelName('free'),
                'description' => $this->telegramService->getChannelDescription('free'),
                'isConfigured' => $this->telegramService->isChannelConfigured('free'),
            ],
            'vipChannel' => [
                'inviteLink' => $this->telegramService->getInviteLink('vip'),
                'name' => $this->telegramService->getChannelName('vip'),
                'description' => $this->telegramService->getChannelDescription('vip'),
                'isConfigured' => $this->telegramService->isChannelConfigured('vip'),
            ],
        ]);
    }
}
