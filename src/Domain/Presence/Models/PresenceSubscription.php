<?php

namespace Domain\Presence\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PresenceSubscription extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'presence_subscriptions';

    protected $fillable = [
        'telegram_id',
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function presence(): BelongsTo
    {
        return $this->belongsTo(Presence::class);
    }
}
