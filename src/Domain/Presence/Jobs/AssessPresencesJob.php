<?php

namespace Domain\Presence\Jobs;

use Domain\Presence\Actions\AssessPresencesAction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Collection;

class AssessPresencesJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Collection $players,
    ) {}

    public function handle(): void
    {
        app(AssessPresencesAction::class)->execute($this->players);
    }
}
