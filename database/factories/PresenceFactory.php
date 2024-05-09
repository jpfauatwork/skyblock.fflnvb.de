<?php

namespace Database\Factories;

use Domain\Player\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;
use Domain\Presence\Models\Presence;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Presence>
 */
class PresenceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Presence::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $joinedAt = fake()->dateTimeBetween('-2 days', '-1 day');
        $leftAt = fake()->dateTimeBetween($joinedAt, '-1 day');
        return [
            'player_id' => Player::factory(),
            'joined_at' => $joinedAt,
            'left_at' => $leftAt,
        ];
    }
}