<?php

namespace App\Services;

use App\Models\TelegramLog;
use App\Models\Tip;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    private string $botToken;
    private string $baseUrl;
    private array $channels;

    public function __construct()
    {
        $this->botToken = config('telegram.bots.mybot.token', '');
        $this->baseUrl = "https://api.telegram.org/bot{$this->botToken}";
        $this->channels = config('telegram.channels', []);
    }

    /**
     * Get channel configuration.
     */
    public function getChannel(string $type = 'vip'): array
    {
        return $this->channels[$type] ?? [];
    }

    /**
     * Get channel ID.
     */
    public function getChannelId(string $type = 'vip'): string
    {
        return $this->channels[$type]['id'] ?? '';
    }

    /**
     * Get channel invite link.
     */
    public function getInviteLink(string $type = 'vip'): ?string
    {
        return $this->channels[$type]['invite_link'] ?? null;
    }

    /**
     * Get channel name.
     */
    public function getChannelName(string $type = 'vip'): string
    {
        return $this->channels[$type]['name'] ?? '';
    }

    /**
     * Get channel description.
     */
    public function getChannelDescription(string $type = 'vip'): string
    {
        return $this->channels[$type]['description'] ?? '';
    }

    /**
     * Send a message to a specific channel type (free or vip).
     */
    public function sendMessageToChannel(string $message, string $channelType = 'vip', array $options = []): array
    {
        $channelId = $this->getChannelId($channelType);
        
        if (empty($channelId)) {
            return [
                'success' => false,
                'error' => "Channel ID not configured for type: {$channelType}",
            ];
        }

        return $this->sendMessage($channelId, $message, $options);
    }

    /**
     * Send a message to a specific chat.
     */
    public function sendMessage(string $chatId, string $message, array $options = []): array
    {
        try {
            $response = Http::post("{$this->baseUrl}/sendMessage", array_merge([
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'HTML',
                'disable_web_page_preview' => true,
            ], $options));

            $data = $response->json();

            if ($response->successful() && ($data['ok'] ?? false)) {
                TelegramLog::logSuccess('send_message', $data);
                return [
                    'success' => true,
                    'message_id' => $data['result']['message_id'] ?? null,
                    'response' => $data,
                ];
            }

            $error = $data['description'] ?? 'Unknown error';
            TelegramLog::logFailure('send_message', $error, $data);

            return [
                'success' => false,
                'error' => $error,
            ];
        } catch (\Exception $e) {
            Log::error('Telegram send message exception', [
                'message' => $e->getMessage(),
            ]);

            TelegramLog::logFailure('send_message', $e->getMessage());

            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Send a tip to the VIP channel.
     */
    public function sendTipToVipChannel(Tip $tip): array
    {
        $message = $this->formatTipMessage($tip, true);
        $result = $this->sendMessageToChannel($message, 'vip');

        if ($result['success']) {
            $tip->markAsTelegramSent();
            TelegramLog::logSuccess('tip_published_vip', $result['response'] ?? [], $tip->id);
        } else {
            TelegramLog::logFailure('tip_published_vip', $result['error'] ?? 'Unknown error', [], $tip->id);
        }

        return $result;
    }

    /**
     * Send a free tip to the free channel.
     */
    public function sendTipToFreeChannel(Tip $tip): array
    {
        $message = $this->formatTipMessage($tip, false);
        $result = $this->sendMessageToChannel($message, 'free');

        if ($result['success']) {
            TelegramLog::logSuccess('tip_published_free', $result['response'] ?? [], $tip->id);
        } else {
            TelegramLog::logFailure('tip_published_free', $result['error'] ?? 'Unknown error', [], $tip->id);
        }

        return $result;
    }

    /**
     * Format a tip as a Telegram message.
     * @param bool $isPremium Whether this is for VIP channel (shows full analysis)
     */
    public function formatTipMessage(Tip $tip, bool $isPremium = true): string
    {
        $emoji = $this->getSportEmoji($tip->sport);
        $stakeStars = str_repeat('⭐', $tip->stake ?? 5);
        
        $channelTag = $isPremium ? '🔥 VIP TIP 🔥' : '💡 FREE TIP 💡';

        $message = "🎯 <b>{$channelTag}</b> 🎯\n\n";
        $message .= "{$emoji} <b>{$tip->title}</b>\n";
        $message .= "━━━━━━━━━━━━━━━━━━\n\n";

        foreach ($tip->selections as $index => $selection) {
            $message .= "📅 <b>" . $selection->event_date->format('M d, Y - H:i') . "</b>\n";
            if ($selection->league) {
                $message .= "🏆 {$selection->league}\n";
            }
            $message .= "⚽ {$selection->event_name}\n";
            $message .= "💡 <b>Pick:</b> {$selection->prediction}\n";
            $message .= "📊 <b>Odds:</b> {$selection->odds}\n";

            if ($index < $tip->selections->count() - 1) {
                $message .= "\n";
            }
        }

        $message .= "\n━━━━━━━━━━━━━━━━━━\n";
        $message .= "📈 <b>Total Odds:</b> {$tip->total_odds}\n";
        $message .= "💰 <b>Stake:</b> {$stakeStars} (" . ($tip->stake ?? 5) . "/10)\n\n";

        if ($isPremium && $tip->analysis) {
            $message .= "📝 <b>Analysis:</b>\n";
            $message .= "<i>{$tip->analysis}</i>\n\n";
        }

        $message .= "🍀 <i>Good luck!</i>\n";
        $message .= "━━━━━━━━━━━━━━━━━━\n";
        $message .= "🌐 <a href=\"" . config('app.url') . "\">BetsLab.io</a>";

        if (!$isPremium) {
            $message .= "\n\n🔓 <i>Want full analysis? Join VIP!</i>";
        }

        return $message;
    }

    /**
     * Format tip result message.
     */
    public function formatTipResultMessage(Tip $tip): string
    {
        $resultEmoji = match ($tip->result) {
            'won' => '✅',
            'lost' => '❌',
            'void' => '🔄',
            default => '⏳',
        };

        $resultText = match ($tip->result) {
            'won' => 'WON',
            'lost' => 'LOST',
            'void' => 'VOID',
            default => 'PENDING',
        };

        $message = "{$resultEmoji} <b>RESULT: {$resultText}</b> {$resultEmoji}\n\n";
        $message .= "📌 {$tip->title}\n";
        $message .= "📊 Odds: {$tip->total_odds}\n\n";

        foreach ($tip->selections as $selection) {
            $selectionEmoji = match ($selection->result) {
                'won' => '✅',
                'lost' => '❌',
                'void' => '🔄',
                default => '⏳',
            };
            $message .= "{$selectionEmoji} {$selection->event_name} - {$selection->prediction}\n";
        }

        return $message;
    }

    /**
     * Send tip result to both channels.
     */
    public function sendTipResultToChannels(Tip $tip, bool $sendToFree = false): array
    {
        $message = $this->formatTipResultMessage($tip);
        
        $results = [];
        $results['vip'] = $this->sendMessageToChannel($message, 'vip');
        
        if ($sendToFree) {
            $results['free'] = $this->sendMessageToChannel($message, 'free');
        }
        
        return $results;
    }

    /**
     * Create a new invite link for a channel.
     */
    public function createInviteLink(string $channelType = 'vip', int $expireDate = null, int $memberLimit = null): array
    {
        try {
            $channelId = $this->getChannelId($channelType);
            
            if (empty($channelId)) {
                return [
                    'success' => false,
                    'error' => "Channel ID not configured for type: {$channelType}",
                ];
            }

            $params = [
                'chat_id' => $channelId,
                'creates_join_request' => false,
            ];

            if ($expireDate) {
                $params['expire_date'] = $expireDate;
            }

            if ($memberLimit) {
                $params['member_limit'] = $memberLimit;
            }

            $response = Http::post("{$this->baseUrl}/createChatInviteLink", $params);
            $data = $response->json();

            if ($response->successful() && ($data['ok'] ?? false)) {
                return [
                    'success' => true,
                    'invite_link' => $data['result']['invite_link'] ?? null,
                    'response' => $data,
                ];
            }

            return [
                'success' => false,
                'error' => $data['description'] ?? 'Unknown error',
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Revoke an invite link.
     */
    public function revokeInviteLink(string $inviteLink, string $channelType = 'vip'): array
    {
        try {
            $channelId = $this->getChannelId($channelType);
            
            $response = Http::post("{$this->baseUrl}/revokeChatInviteLink", [
                'chat_id' => $channelId,
                'invite_link' => $inviteLink,
            ]);

            $data = $response->json();

            return [
                'success' => $response->successful() && ($data['ok'] ?? false),
                'response' => $data,
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Get emoji for sport.
     */
    private function getSportEmoji(string $sport): string
    {
        return match (strtolower($sport)) {
            'football', 'fotbal', 'soccer' => '⚽',
            'tennis', 'tenis' => '🎾',
            'basketball', 'baschet' => '🏀',
            'hockey', 'hochei' => '🏒',
            'volleyball', 'volei' => '🏐',
            'handball', 'handbal' => '🤾',
            'baseball' => '⚾',
            'american football' => '🏈',
            'mma', 'ufc', 'boxing' => '🥊',
            'esports', 'e-sports' => '🎮',
            default => '🏆',
        };
    }

    /**
     * Check if bot is properly configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->botToken);
    }

    /**
     * Check if a specific channel is configured.
     */
    public function isChannelConfigured(string $type = 'vip'): bool
    {
        return !empty($this->getChannelId($type)) && !empty($this->getInviteLink($type));
    }

    /**
     * Get bot info.
     */
    public function getBotInfo(): array
    {
        try {
            $response = Http::get("{$this->baseUrl}/getMe");
            return $response->json();
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
