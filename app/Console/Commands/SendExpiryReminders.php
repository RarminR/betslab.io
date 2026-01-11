<?php

namespace App\Console\Commands;

use App\Notifications\SubscriptionExpiringNotification;
use App\Services\SubscriptionService;
use Illuminate\Console\Command;

class SendExpiryReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:send-expiry-reminders {--days=3 : Number of days before expiry}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder emails to users with subscriptions expiring soon';

    /**
     * Execute the console command.
     */
    public function handle(SubscriptionService $subscriptionService): int
    {
        $days = (int) $this->option('days');

        $this->info("Checking for subscriptions expiring in {$days} days...");

        $subscriptions = $subscriptionService->getExpiringSubscriptions($days);

        $count = 0;
        foreach ($subscriptions as $subscription) {
            $subscription->user->notify(new SubscriptionExpiringNotification($subscription));
            $count++;
            $this->line("Sent reminder to: {$subscription->user->email}");
        }

        $this->info("Sent {$count} reminder emails.");

        return Command::SUCCESS;
    }
}

