<?php

namespace Domain\Presence\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Spatie\ModelStates\HasStates;

/**
 * @property int $id
 * @property Carbon $date
 */
class DailyPlayerPresence extends Model
{
    use HasStates;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'daily_player_presences';

    protected $fillable = [
        'date',
        'playtime_minutes',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];
}
