<?php

namespace Domain\Presence\Actions;

use Domain\Presence\Models\Player;
use Domain\Presence\Models\Presence;
use Domain\Shared\Data\PresenceData;
use Domain\Shared\Events\PlayersJoinedEvent;
use Domain\Shared\Events\PlayersLeftEvent;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

/**
 * @property Collection<int, string> $playerNames
 * @property EloquentCollection<int, Player> $activePlayers
 * @property EloquentCollection<int, Presence> $openPresences
 */
class AssessPresencesAction
{
    protected Collection $playerNames;

    protected EloquentCollection $activePlayers;

    protected EloquentCollection $openPresences;

    public function execute(array $playerNames): void
    {
        $this->playerNames = collect($playerNames);

        $this->collectOpenPresences();
        $this->registerNewPresences();
        $this->closeOldPresences();
        $this->reopenLivePresencesAtMidnight();
    }

    protected function collectOpenPresences(): void
    {
        $this->openPresences = Presence::query()
            ->whereNull('left_at')
            ->get();
    }

    protected function registerNewPresences(): void
    {
        $playersWithOutOpenPresences = $this->playerNames
            ->diff($this->openPresences->pluck('name'));

        $presencesToBeCreated = [];

        $playersWithOutOpenPresences->each(function (string $playerName) use (&$presencesToBeCreated) {
            $presencesToBeCreated[] = [
                'name' => $playerName,
                'joined_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        });

        Presence::query()->insert($presencesToBeCreated);

        $presencesCreated = $presencesToBeCreated;

        PlayersJoinedEvent::dispatch(PresenceData::collect($presencesCreated, Collection::class));
    }

    protected function closeOldPresences(): void
    {
        $presencesToBeClosed = $this->openPresences
            ->whereNotIn('name', $this->playerNames);

        Presence::query()
            ->whereIn('id', $presencesToBeClosed->pluck('id'))
            ->update([
                'left_at' => now(),
            ]);

        $presencesClosed = $presencesToBeClosed;

        PlayersLeftEvent::dispatch(PresenceData::collect($presencesClosed, Collection::class));
    }

    protected function reopenLivePresencesAtMidnight(): void
    {
        if (! now()->between(
            now()->startOfDay(),
            now()->startOfDay()->addMinutes(1)
        )) {
            return;
        }

        $toBeReopenedEntries = Presence::query()
            ->whereIn('name', $this->playerNames)
            ->where('joined_at', '<', now()->startOfDay())
            ->whereNull('left_at');

        $reopenedPresences = $toBeReopenedEntries->get()
            ->map(fn (Presence $presence) => [
                'player_id' => $presence->player_id,
                'name' => $presence->name,
                'joined_at' => now()->startOfDay(),
                'created_at' => now(),
                'updated_at' => now(),
            ])
            ->toArray();

        $toBeReopenedEntries->update([
            'left_at' => now()->yesterday()->endOfDay(),
        ]);

        Presence::query()->insert($reopenedPresences);
    }
}
