<?php

namespace Domain\Presence\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Spatie\ModelStates\HasStates;

/**
 * @property Carbon $date
 */
class DailyPresence extends Model
{
    use HasStates;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'daily_presences';

    protected $fillable = [
        'date',
        'unique_players',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];
}
