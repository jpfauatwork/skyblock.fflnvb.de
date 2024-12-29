<?php

namespace Domain\Player\Support\Mojang\ProfilesApi;

use Domain\Player\Support\Mojang\Data\ProfileData;
use Domain\Player\Support\Mojang\Exceptions\NoProfilesRequested;
use Domain\Player\Support\Mojang\Exceptions\TooManyProfilesRequested;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Throwable;

/** @property Collection<int, ProfileData> $profiles */
class Client
{
    protected Collection $profiles;

    public bool $isSuccessful = false;

    public string $errorMessage = 'No request sent';

    /** @param Collection<int, ProfileData> $profiles */
    public function post(Collection $profiles): self
    {
        try {
            $this->checkProfileCollection($profiles);

            $names = $profiles->pluck('name')->toArray();

            $response = $this->sendRequest($names);

            $this->profiles = ProfileData::collect($response, Collection::class);
        } catch (Throwable $e) {
            $this->errorMessage = $e->getMessage();
            $this->profiles = collect();
            return $this;
        }

        $this->errorMessage = 'No errors';
        $this->isSuccessful = true;

        return $this;
    }

    protected function sendRequest(array $names): array
    {
        $request = Http::withHeader('Content-Type', 'application/json')
            ->acceptJson()
            ->post(
                config('mojang.profiles_api_url'),
                $names
            );

        return $request->json();
    }

    /** @return Collection<int, ProfileData>|null */
    public function response(): ?Collection
    {
        if (! $this->isSuccessful) {
            return null;
        }

        return $this->profiles;
    }

    /** @param Collection<int, ProfileData> $profiles */
    protected function checkProfileCollection(Collection $profiles): void
    {
        $count = $profiles->count();

        match (true) {
            $count === 0 => throw new NoProfilesRequested,
            $count > 10 => throw new TooManyProfilesRequested($count),
            default => null,
        };
    }
}
