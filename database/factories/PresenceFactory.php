<?php

namespace Database\Factories;

use Domain\Presence\Models\Player;
use Domain\Presence\Models\Presence;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Presence>
 */
class PresenceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Presence>
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
