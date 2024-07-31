<?php

namespace Domain\Subscription\Actions;

use Domain\Shared\Data\PresenceData;
use Domain\Subscription\Enums\EventNames;
use Domain\Subscription\Models\Subscription;
use Domain\Subscription\Notifications\PlayerLeftNotification;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Collection;

/**
 * @property Collection<int, PresenceData> $presenceDataCollection
 * @property EloquentCollection<int, Notification> $subscriptionsToBeAssessed
 */
class AssessSubscriptionsAction
{
    protected Collection $presenceDataCollection;

    protected EloquentCollection $subscriptionsToBeAssessed;

    /** @var Collection<int, PresenceDataCollection> */
    public function execute(Collection $presenceDataCollection): void
    {
        $this->presenceDataCollection = $presenceDataCollection;

        $this->collectSubscriptionsToBeTriggered();
        $this->triggerLeftNotifications();
    }

    protected function collectSubscriptionsToBeTriggered(): void
    {
        $this->subscriptionsToBeAssessed = Subscription::query()
            ->whereIn('context_player_id', $this->presenceDataCollection->pluck('player_name'))
            ->orWhereIn('context_player_name', $this->presenceDataCollection->pluck('name'))
            ->get();
    }

    protected function triggerLeftNotifications(): void
    {
        $this->subscriptionsToBeAssessed
            ->where('event_name', EventNames::PLAYER_LEFT)
            ->each(function (Subscription $subscription) {
                $matchingPresenceData = $this->presenceDataCollection
                    ->filter(fn (PresenceData $presenceData) => $presenceData->playerId === $subscription->context_player_id
                            || $presenceData->name === $subscription->context_player_name
                    )
                    ->first();

                if ($matchingPresenceData->leftAt) {
                    return;
                }

                $subscription->notify(new PlayerLeftNotification($subscription));
            });
    }
}
