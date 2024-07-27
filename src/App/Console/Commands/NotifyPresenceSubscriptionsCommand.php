<?php

namespace App\Console\Commands;

use Domain\Presence\Models\Player;
use Domain\Presence\Models\Presence;
use Domain\Presence\Models\PresenceSubscription;
use Domain\Presence\Notifications\PlayerDisconnectedNotification;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Sleep;

/**
 * @property Collection<int, PresenceSubscription> $presenceSubscriptions
 * @property Collection<int, PresenceSubscription> $presenceSubscriptionsToNotify
 */
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
    protected $description = 'Notify subscribed Players on disconnection';

    protected EloquentCollection $presenceSubscriptions;

    protected EloquentCollection $presenceSubscriptionsToNotify;

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->registerPresenceSubscriptions();

        $this->checkPresenceSubscriptions();

        $this->notifyPresenceSubscriptions();
    }

    protected function registerPresenceSubscriptions(): void
    {
        $this->presenceSubscriptions = PresenceSubscription::query()
            ->with('player')
            ->get();
    }

    protected function checkPresenceSubscriptions(): void
    {
        $this->presenceSubscriptions->each(function (PresenceSubscription $subscription) {
            $lastPresence = $this->lastPresence($subscription->player);

            if ($this->notificationIsRequired($subscription, $lastPresence)) {
                $this->updateSubscription($subscription, $lastPresence);
                $this->presenceSubscriptionsToNotify->push($subscription);
            }
        });
    }

    protected function lastPresence(Player $player): ?Presence
    {
        return Presence::query()
            ->where('player_id', $player->id)
            ->latest()
            ->first();
    }

    protected function notificationIsRequired(PresenceSubscription $subscription, ?Presence $lastPresence): bool
    {
        if (is_null($lastPresence)) {
            return false;
        }

        return $this->playerIsNotOnline($lastPresence)
            && $this->userHasNotBeenNotifiedYet($subscription, $lastPresence);
    }

    protected function playerIsNotOnline(Presence $lastPresence): bool
    {
        return filled($lastPresence->left_at);
    }

    protected function userHasNotBeenNotifiedYet(PresenceSubscription $subscription, Presence $lastPresence): bool
    {
        return $subscription->presence_id !== $lastPresence->id;
    }

    protected function updateSubscription(PresenceSubscription $subscription, Presence $lastPresence): void
    {
        $subscription->update([
            'presence_id' => $lastPresence->id,
        ]);
    }

    protected function notifyPresenceSubscriptions(): void
    {
        $this->presenceSubscriptionsToNotify->each(function (PresenceSubscription $subscription) {
            $subscription->player->notify(new PlayerDisconnectedNotification($subscription));
            Sleep::for(5)->seconds();
        });
    }
}
