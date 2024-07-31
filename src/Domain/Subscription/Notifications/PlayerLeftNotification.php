<?php

namespace Domain\Subscription\Notifications;

use Domain\Subscription\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class PlayerLeftNotification extends Notification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(Subscription $subscription): array
    {
        return match (true) {
            filled($subscription->via_telegram) => ['telegram'],
            default => [],
        };
    }

    /**
     * Get the telegram representation of the notification.
     */
    public function toTelegram(Subscription $subscription)
    {
        $message = 'Player '.$subscription->context_player_name.' has Left the Server';

        return TelegramMessage::create()
            ->to($subscription->via_telegram)
            ->content($message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
