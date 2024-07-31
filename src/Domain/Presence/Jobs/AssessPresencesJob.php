<?php

namespace Domain\Presence\Jobs;

use Domain\Presence\Actions\AssessPresencesAction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class AssessPresencesJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public array $playerNames,
    ) {}

    public function handle(): void
    {
        app(AssessPresencesAction::class)->execute($this->playerNames);
    }
}
