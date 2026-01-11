<?php

namespace App\Notifications;

use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscriptionExpiredNotification extends Notification implements ShouldQueue
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
        return (new MailMessage)
            ->subject('⏰ Abonament Expirat - BetsLab.io')
            ->greeting('Salut, ' . $notifiable->name . '!')
            ->line('Abonamentul tău la BetsLab.io a expirat.')
            ->line('Nu rata pronosticurile noastre! Reînnoiește acum pentru a continua să primești tips-uri câștigătoare.')
            ->action('Reînnoiește Abonamentul', url('/pricing'))
            ->line('Ne bucurăm să te avem înapoi!')
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
            'expired_at' => $this->subscription->ends_at,
        ];
    }
}

