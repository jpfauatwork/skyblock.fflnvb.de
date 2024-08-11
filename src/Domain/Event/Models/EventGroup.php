<?php

namespace Domain\Event\Models;

use Database\Factories\EventGroupFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 */
class EventGroup extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'event_groups';

    protected $fillable = [
        'name',
        'description',
        'order_column',
    ];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public static function newFactory(): Factory
    {
        return EventGroupFactory::new();
    }
}
