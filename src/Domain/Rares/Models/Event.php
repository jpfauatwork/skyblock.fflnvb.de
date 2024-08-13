<?php

namespace Domain\Rares\Models;

use Database\Factories\EventFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $event_group_id
 * @property string $name
 * @property string|null $description
 * @property Carbon $occured_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 */
class Event extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'events';

    protected $fillable = [
        'event_group_id',
        'name',
        'description',
        'occured_at',
    ];

    protected $casts = [
        'occured_at' => 'datetime',
    ];

    public function eventGroup(): BelongsTo
    {
        return $this->belongsTo(EventGroup::class);
    }

    public function collectibles(): HasMany
    {
        return $this->hasMany(Collectible::class);
    }

    public static function newFactory(): Factory
    {
        return EventFactory::new();
    }
}
