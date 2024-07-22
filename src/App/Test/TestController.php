<?php

namespace App\Test;

use App\Test\Resources\PresenceResource;
use Domain\Presence\Models\Presence;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TestController
{
    public function __invoke(): ResourceCollection
    {
        $presences = Presence::query()
            ->with('player')
            ->orderBy('updated_at', 'desc')
            ->limit(100)
            ->get();

        return PresenceResource::collection($presences);
    }
}
