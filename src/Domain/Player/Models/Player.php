<?php

namespace Domain\Player\Models;

use Database\Factories\PlayerFactory;
use Domain\Player\States\PlayerState;
use Domain\Player\States\Registered;
use Domain\Presence\Models\Presence;
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
    use HasStates;
    use HasFactory;

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
