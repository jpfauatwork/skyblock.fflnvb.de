<?php

namespace Domain\Event\Models;

use Database\Factories\CollectibleFactory;
use Domain\Event\Enums\CollectibleTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $event_id
 * @property CollectibleTypeEnum $type
 * @property string $name
 * @property string|null $lore
 * @property int $amount
 * @property Carbon|null $collected_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 */
class Collectible extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'collectibles';

    protected $fillable = [
        'event_id',
        'type',
        'name',
        'lore',
        'amount',
        'collected_at',
    ];

    protected $casts = [
        'type' => CollectibleTypeEnum::class,
        'collected_at' => 'datetime',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public static function newFactory(): Factory
    {
        return CollectibleFactory::new();
    }
}
