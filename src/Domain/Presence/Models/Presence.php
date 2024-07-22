<?php

namespace Domain\Presence\Models;

use Database\Factories\PresenceFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Spatie\ModelStates\HasStates;

/**
 * @property Carbon joined_at
 * @property Carbon left_at
 */
class Presence extends Model
{
    use HasFactory;
    use HasStates;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'presences';

    protected $fillable = [
        'player_id',
        'joined_at',
        'left_at',
        'playtime_minutes',
    ];

    protected $casts = [
        'joined_at' => 'datetime',
        'left_at' => 'datetime',
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public static function newFactory(): Factory
    {
        return PresenceFactory::new();
    }
}
