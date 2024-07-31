<?php

namespace Domain\Subscription\Models;

use Database\Factories\SubscriptionFactory;
use Domain\Subscription\Enums\EventNames;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $event_name
 * @property int|null $context_player_id
 * @property string|null $context_player_name
 * @property string|null $via_telegram
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 */
class Subscription extends Model
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subscriptions';

    protected $fillable = [
        'via_telegram',
    ];

    protected function casts(): array
    {
        return [
            'event_name' => EventNames::class,
        ];
    }

    public static function newFactory(): Factory
    {
        return SubscriptionFactory::new();
    }
}
