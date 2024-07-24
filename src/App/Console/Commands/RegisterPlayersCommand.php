<?php

namespace App\Console\Commands;

use Domain\Presence\Actions\RegisterPlayersAction;
use Illuminate\Console\Command;

class RegisterPlayersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'players:register';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Registering Players';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        app(RegisterPlayersAction::class)->execute();
    }
}
