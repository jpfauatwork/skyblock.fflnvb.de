<?php

namespace Database\Factories;

use Domain\Player\States\Registered;
use Illuminate\Database\Eloquent\Factories\Factory;
use Domain\Player\Models\Player;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Player>
 */
class PlayerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Player::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mojang_id' => $this->faker->uuid(),
            'name' => $this->faker->name(),
            'aliases' => null,
            'is_bedrock' => false,
            'alt_from' => null,
            'state' => Registered::$name,
        ];
    }
}