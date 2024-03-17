<?php

namespace App\Console\Commands;

use Domain\Player\Models\Player;
use Domain\Player\States\Failed;
use Domain\Player\States\Registered;
use Domain\Player\States\Scanned;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class RegisterPlayers extends Command
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

    //TODO: flag skip mojang
    //TODO: mass, default 1, foreach go through, default sleep
    //TODO: Attempts before fail, default 3,
    //TODO: Override failed Player manually
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $player = Player::query()
            ->whereState('state', [Scanned::class, Failed::class])
            ->first();

        if (! $player) {
            $this->info('No Players to Register');

            return;
        }

        match ($player->name[0]) {
            '.' => $this->registerBedRockPlayer($player),
            default => $this->registerJavaPlayer($player),
        };
    }

    private function registerJavaPlayer(Player $player)
    {

        $mojangId = $this->getMojangId($player);

        $player->mojang_id = $mojangId;
        $player->is_bedrock = false;
        $player->state->transitionTo(Registered::class);
        $player->save();

        $this->info("Java Player {$player->name} Registered");
    }

    private function registerBedRockPlayer(Player $player)
    {
        $player->mojang_id = $player->name;
        $player->is_bedrock = true;
        $player->state->transitionTo(Registered::class);
        $player->save();

        $this->info("Bedrock Player {$player->name} Registered");
    }

    private function getMojangId(Player $player)
    {
        $response = Http::acceptJson()
            ->withUrlParameters(['playername' => $player->name])
            ->get('https://api.mojang.com/users/profiles/minecraft/{playername}');

        return match ($response->status()) {
            200 => $response->json()['id'],
            429 => $this->setRegistrationFailed($player, 'Too Many Requests'),
            404 => $this->setRegistrationFailed($player, 'Player Not Found'),
            default => $this->setRegistrationFailed($player, "Unhandled response status {$response->status()}"),
        };
    }

    private function setRegistrationFailed(Player $player, string $reason)
    {
        $player->state->transitionTo(Failed::class);
        $player->save();
        $this->error("Registration of Player {$player->name} failed: {$reason}");
        exit();
    }
}
