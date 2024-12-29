<?php

namespace App\Console\Commands;

use Domain\Server\Actions\ScanServerAction;
use Domain\Server\Support\Enums\Server;
use Exception;
use Illuminate\Console\Command;

class ScanServerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'servers:scan {server}';

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
        $server = match ($this->argument('server')) {
            'skyblock-economy' => Server::SkyblockEconomy,
            default => throw new Exception('Invalid server id'),
        };

        app(ScanServerAction::class)->execute($server);
    }
}
