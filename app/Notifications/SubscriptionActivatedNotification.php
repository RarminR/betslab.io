<?php

namespace App\Notifications;

use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscriptionActivatedNotification extends Notification implements ShouldQueue
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
        $plan = $this->subscription->plan;
        $endsAt = $this->subscription->ends_at
            ? $this->subscription->ends_at->format('d.m.Y')
            : 'Nelimitat (Lifetime)';

        return (new MailMessage)
            ->subject('🎉 Abonament Activat - BetsLab.io')
            ->greeting('Salut, ' . $notifiable->name . '!')
            ->line('Îți mulțumim pentru achiziție! Abonamentul tău a fost activat cu succes.')
            ->line("**Plan:** {$plan->name}")
            ->line("**Preț:** {$plan->formatted_price}")
            ->line("**Valabil până la:** {$endsAt}")
            ->line('Acum ai acces la toate pronosticurile noastre și la canalul privat de Telegram.')
            ->action('Accesează Dashboard', url('/dashboard'))
            ->line('Succes la pariuri!')
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
            'plan_name' => $this->subscription->plan->name,
            'ends_at' => $this->subscription->ends_at,
        ];
    }
}

