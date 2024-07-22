<?php

namespace Domain\Presence\Models;

use Database\Factories\PlayerFactory;
use Domain\Presence\States\Player\PlayerState;
use Domain\Presence\States\Player\Registered;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\ModelStates\HasStates;

/**
 * @property PlayerState $state
 */
class Player extends Model
{
    use HasFactory;
    use HasStates;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'players';

    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'is_bedrock' => 'boolean',
        'state' => PlayerState::class,
    ];

    public function scopeRegistered($query)
    {
        return $query->whereState('state', Registered::class);
    }

    public function presences(): HasMany
    {
        return $this->hasMany(Presence::class);
    }

    public static function newFactory(): Factory
    {
        return PlayerFactory::new();
    }
}
