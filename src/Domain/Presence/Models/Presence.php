<?php

namespace Domain\Presence\Models;

use Database\Factories\PresenceFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Spatie\ModelStates\HasStates;

/**
 * @property int $id
 * @property int $player_id
 * @property string $name
 * @property Carbon|null $joined_at
 * @property Carbon|null $left_at
 * @property int $playtime_minutes
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
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
        'name',
        'joined_at',
        'left_at',
        'playtime_minutes',
    ];

    public static function newFactory(): Factory
    {
        return PresenceFactory::new();
    }
}
