<?php

namespace Domain\Player\Actions;

use Domain\Player\Models\Player;
use Domain\Player\Support\Mojang\Data\ProfileData;
use Domain\Player\Support\Mojang\ProfilesApi\Client;
use Domain\Shared\Data\PlayerData;
use Domain\Shared\Events\PlayersIdentifiedEvent;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * @property Collection<int, string> $names
 * @property Collection<int, string> $javaPlayers
 * @property Collection<int, string> $bedrockPlayers
 */
class RegisterPlayersAction
{
    protected Collection $names;

    protected Collection $javaPlayers;

    protected Collection $bedrockPlayers;

    protected string $registeringUuid;

    public function execute(Collection $names): void
    {
        $this->names = $names;
        $this->registeringUuid = Str::uuid();

        $this->identifyJavaPlayers();
        $this->identifyBedrockPlayers();

        $this->registerJavaPlayers();
        $this->registerBedrockPlayers();

        $this->dispatchIdentifiedPlayers();
    }

    protected function identifyJavaPlayers(): void
    {
        $this->javaPlayers = $this->names
            ->filter(fn (string $name) => ! Str::startsWith($name, '.'));
    }

    protected function identifyBedrockPlayers(): void
    {
        $this->bedrockPlayers = $this->names
            ->filter(fn (string $name) => Str::startsWith($name, '.'));
    }

    protected function registerBedrockPlayers()
    {
        $insert = $this->bedrockPlayers
            ->map(fn (string $name) => [
                'name' => $name,
                'is_bedrock' => true,
                'registering_uuid' => $this->registeringUuid,
                'created_at' => now(),
                'updated_at' => now(),
            ])
            ->toArray();

        Player::query()->insert($insert);
    }

    protected function registerJavaPlayers()
    {
        $this->javaPlayers->chunk(10)->each(function (Collection $players) {
            $profilesToBeRegistered = ProfileData::collect(
                $players->map(fn (string $name) => [
                    'name' => $name,
                ]),
                Collection::class
            );

            $mojangProfilesRequest = app(Client::class)->post($profilesToBeRegistered);

            if (! $mojangProfilesRequest->isSuccessful) {
                return true;
            }

            $profilesWithUuid = $mojangProfilesRequest->response();

            $insert = $profilesWithUuid
                ->map(fn (ProfileData $profile) => [
                    'name' => $profile->name,
                    'mojang_id' => $profile->mojangId,
                    'is_bedrock' => false,
                    'registering_uuid' => $this->registeringUuid,
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
                ->toArray();

            Player::query()->insert($insert);
            sleep(2);
        });
    }

    public function dispatchIdentifiedPlayers(): void
    {
        $identifiedPlayers = Player::query()
            ->where('registering_uuid', $this->registeringUuid)
            ->select([
                'id',
                'name',
            ])
            ->get();

        PlayersIdentifiedEvent::dispatch(PlayerData::collect($identifiedPlayers, Collection::class));
    }
}
