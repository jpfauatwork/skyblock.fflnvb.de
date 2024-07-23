<?php

namespace App\PublicApi\Presences\Resources;

use Domain\Presence\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Presence
 */
class PresenceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->player->name,
            'joined_at' => $this->joined_at,
            'left_at' => $this->left_at,
        ];
    }
}
