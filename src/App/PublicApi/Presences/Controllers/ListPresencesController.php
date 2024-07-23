<?php

namespace App\PublicApi\Presences\Controllers;

use App\PublicApi\Presences\Queries\PresenceQuery;
use App\PublicApi\Presences\Resources\PresenceResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ListPresencesController
{
    public function __invoke(PresenceQuery $query): ResourceCollection
    {
        return PresenceResource::collection($query->paginate(100));
    }
}
