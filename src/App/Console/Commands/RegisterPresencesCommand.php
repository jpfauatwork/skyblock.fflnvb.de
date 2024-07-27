<?php

namespace App\Console\Commands;

use Domain\Presence\Actions\RegisterPresencesAction;
use Illuminate\Console\Command;

class RegisterPresencesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'skyblock:register-presences';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checking Server Status';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        app(RegisterPresencesAction::class)->execute();
    }
}
