<?php

namespace App\Listeners;

use App\Events\SubscriptionExpired;
use App\Notifications\SubscriptionExpiredNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSubscriptionExpiredEmail implements ShouldQueue
{
    /**
     * Handle the event.
     */
    public function handle(SubscriptionExpired $event): void
    {
        $event->subscription->user->notify(new SubscriptionExpiredNotification($event->subscription));
    }
}

