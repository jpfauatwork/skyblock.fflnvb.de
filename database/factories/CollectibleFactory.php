<?php

namespace Database\Factories;

use Domain\Rares\Enums\CollectibleTypeEnum;
use Domain\Rares\Models\Collectible;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Collectible>
 */
class CollectibleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Collectible>
     */
    protected $model = Collectible::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(array_column(CollectibleTypeEnum::cases(), 'value')),
            'name' => $this->faker->name(),
            'amount' => $this->faker->randomElement([5, 10, 15, 20]),
        ];
    }
}
