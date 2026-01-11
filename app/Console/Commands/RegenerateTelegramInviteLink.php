<?php

namespace App\Console\Commands;

use App\Services\TelegramService;
use Illuminate\Console\Command;

class RegenerateTelegramInviteLink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:regenerate-invite-link';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Regenerate Telegram channel invite link';

    /**
     * Execute the console command.
     */
    public function handle(TelegramService $telegramService): int
    {
        if (!$telegramService->isConfigured()) {
            $this->error('Telegram bot is not configured.');
            return Command::FAILURE;
        }

        $this->info('Creating new invite link...');

        // Expire in 7 days
        $expireDate = now()->addDays(7)->timestamp;

        $result = $telegramService->createInviteLink($expireDate);

        if ($result['success']) {
            $this->info('New invite link created: ' . $result['invite_link']);
            $this->warn('Update TELEGRAM_INVITE_LINK in .env with the new link.');
            return Command::SUCCESS;
        }

        $this->error('Failed to create invite link: ' . ($result['error'] ?? 'Unknown error'));
        return Command::FAILURE;
    }
}

