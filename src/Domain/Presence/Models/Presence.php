<?php

namespace Domain\Presence\Models;

use Domain\Player\Models\Player;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\ModelStates\HasStates;

class Presence extends Model
{
    use HasStates;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'presences';

    protected $fillable = [
        'player_id',
        'joined_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }
}
