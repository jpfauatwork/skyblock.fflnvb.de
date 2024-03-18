<?php

namespace App\Console\Commands;

use Domain\Presence\Models\Presence;
use Domain\Presence\Models\PresenceSubscription;
use Domain\Presence\Notifications\PlayerDisconnectedNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Sleep;

class NotifyPresenceSubscriptionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'skyblock:notify-presence-subscriptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify Users via Telegram when player left';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $notifications = collect();

        PresenceSubscription::all()
            ->each(function (PresenceSubscription $subscription) use ($notifications) {
                $lastPresence = Presence::query()
                    ->where('player_id', $subscription->player_id)
                    ->latest()
                    ->first();

                if ($lastPresence->left_at && $subscription->presence_id !== $lastPresence->id) {
                    $subscription->presence()->associate($lastPresence);
                    $subscription->save();

                    $notifications->push($subscription);
                }
            });

        $notifications->each(function (PresenceSubscription $subscription) {
            $subscription->user->notify(new PlayerDisconnectedNotification($subscription));
            Sleep::for(5)->seconds();
        });
    }
}
