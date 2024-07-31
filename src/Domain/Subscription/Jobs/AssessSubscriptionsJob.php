<?php

namespace Domain\Subscription\Jobs;

use Domain\Shared\Data\PresenceData;
use Domain\Subscription\Actions\AssessSubscriptionsAction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Collection;

/**
 * @property Collection<int, PresenceData> $presenceDataCollection
 */
class AssessSubscriptionsJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Collection $presenceDataCollection,
    ) {}

    public function handle(): void
    {
        app(AssessSubscriptionsAction::class)->execute($this->presenceDataCollection);
    }
}
