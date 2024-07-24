<?php

namespace Domain\Presence\Actions;

use Domain\Presence\Models\Player;
use Domain\Presence\States\Player\Failed;
use Domain\Presence\States\Player\Registered;
use Domain\Presence\States\Player\Scanned;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Support\Mojang\Data\ProfileData;
use Support\Mojang\ProfilesApi\Client;

/**
 * @property EloquentCollection<int, Player> $players
 * @property EloquentCollection<int, Player> $javaPlayers
 * @property EloquentCollection<int, Player> $bedrockPlayers
 */
class RegisterPlayersAction
{
    protected EloquentCollection $players;

    protected EloquentCollection $javaPlayers;

    protected EloquentCollection $bedrockPlayers;

    public function execute()
    {
        $this->retrieveUnregisteredPlayers();

        $this->identifyJavaPlayers();
        $this->identifyBedrockPlayers();

        $this->registerJavaPlayers();
        $this->registerBedrockPlayers();
    }

    protected function retrieveUnregisteredPlayers(): void
    {
        $this->players = Player::query()
            ->whereState('state', [Scanned::class, Failed::class])
            ->orderBy('created_at', 'asc')
            ->orderBy('id', 'asc')
            ->get();
    }

    protected function identifyJavaPlayers(): void
    {
        $this->javaPlayers = $this->players
            ->filter(fn (Player $player) => ! Str::startsWith($player->name, '.'))
            ->take(10);
    }

    protected function identifyBedrockPlayers(): void
    {
        $this->bedrockPlayers = $this->players
            ->filter(fn (Player $player) => Str::startsWith($player->name, '.'));
    }

    protected function registerBedrockPlayers()
    {
        $massInsert = $this->bedrockPlayers
            ->map(fn (Player $player) => [
                'id' => $player->id,
                'name' => $player->name,
                'is_bedrock' => true,
                'state' => Registered::$name,
            ]
            )
            ->toArray();

        Player::query()->upsert($massInsert, ['id']);
    }

    protected function registerJavaPlayers()
    {
        $profilesToBeRegistered = ProfileData::collect(
            $this->javaPlayers->map(fn (Player $player) => [
                'name' => $player->name,
            ]),
            Collection::class
        );

        $mojangProfilesRequest = app(Client::class)->post($profilesToBeRegistered);

        $profilesWithUuid = $mojangProfilesRequest->response();

        $massInsert = $profilesWithUuid
            ->map(fn (ProfileData $profile) => [
                'id' => $this->javaPlayers->where('name', $profile->name)->first()->id,
                'name' => $profile->name,
                'mojang_id' => $profile->mojangId,
                'is_bedrock' => false,
                'state' => Registered::$name,
            ])
            ->toArray();

        Player::query()->upsert($massInsert, ['id']);
    }
}
