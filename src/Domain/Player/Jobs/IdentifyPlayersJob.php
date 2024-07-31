<?php

namespace Domain\Player\Jobs;

use Domain\Player\Actions\IdentifyPlayersAction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Collection;

/**
 * @property Collection<int, string> $names
 */
class IdentifyPlayersJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Collection $names,
    ) {}

    public function handle(): void
    {
        app(IdentifyPlayersAction::class)->execute($this->names);
    }
}
