<?php

namespace App\Notifications;

use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscriptionExpiringNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Subscription $subscription
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $daysRemaining = $this->subscription->days_remaining;
        $expiresAt = $this->subscription->ends_at->format('d.m.Y');

        return (new MailMessage)
            ->subject("⚠️ Abonamentul tău expiră în {$daysRemaining} zile - BetsLab.io")
            ->greeting('Salut, ' . $notifiable->name . '!')
            ->line("Abonamentul tău la BetsLab.io expiră pe **{$expiresAt}**.")
            ->line("Mai ai doar **{$daysRemaining} zile** pentru a te bucura de pronosticurile noastre.")
            ->line('Reînnoiește acum pentru a nu pierde accesul la tips-uri și la canalul Telegram!')
            ->action('Reînnoiește Abonamentul', url('/pricing'))
            ->line('Mulțumim că faci parte din comunitatea BetsLab!')
            ->salutation('Echipa BetsLab.io');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'subscription_id' => $this->subscription->id,
            'expires_at' => $this->subscription->ends_at,
            'days_remaining' => $this->subscription->days_remaining,
        ];
    }
}

