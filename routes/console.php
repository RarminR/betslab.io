<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Check and expire subscriptions daily at 1:00 AM
Schedule::command('subscriptions:check-expired')->dailyAt('01:00');

// Send expiry reminders daily at 9:00 AM (3 days before expiry)
Schedule::command('subscriptions:send-expiry-reminders --days=3')->dailyAt('09:00');

// Regenerate Telegram invite link every week on Sunday
Schedule::command('telegram:regenerate-invite-link')->weeklyOn(0, '00:00');
