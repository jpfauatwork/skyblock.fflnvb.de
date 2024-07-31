<?php

namespace Domain\Player\Jobs;

use Domain\Player\Actions\RegisterPlayersAction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Collection;

/**
 * @property Collection<int, string> $names
 */
class RegisterPlayersJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Collection $names,
    ) {}

    public function handle(): void
    {
        app(RegisterPlayersAction::class)->execute($this->names);
    }
}
