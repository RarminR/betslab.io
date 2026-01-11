<?php

namespace App\Listeners;

use App\Events\SubscriptionActivated;
use App\Notifications\SubscriptionActivatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSubscriptionConfirmationEmail implements ShouldQueue
{
    /**
     * Handle the event.
     */
    public function handle(SubscriptionActivated $event): void
    {
        $event->subscription->user->notify(new SubscriptionActivatedNotification($event->subscription));
    }
}

