<?php

namespace Support\Data;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ServerStatusData extends Data
{
    public function __construct(
        public bool $online,
        public int $playersOnline,
        public int $maxPlayers,
        /** @var Collection<int, PlayerData> */
        public Collection $playerList,
    ) {}

    public static function createFromSkyblockClient(array $response): self
    {
        $serverStatus = $response['serverStatus'];
        $playerList = collect($serverStatus['player_list'])
            ->map(function (string $player) {
                return ['name' => $player];
            });

        return self::from(Arr::set(
            $serverStatus,
            'player_list',
            $playerList,
        ));
    }
}
