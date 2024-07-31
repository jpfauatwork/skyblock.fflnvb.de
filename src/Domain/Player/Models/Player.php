<?php

namespace Domain\Player\Models;

use Database\Factories\PlayerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $mojang_id
 * @property string $name
 * @property bool $is_bedrock
 * @property int|null $alt_of
 * @property Carbon|null $joined_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Player extends Model
{
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
    ];

    public static function newFactory(): Factory
    {
        return PlayerFactory::new();
    }
}
