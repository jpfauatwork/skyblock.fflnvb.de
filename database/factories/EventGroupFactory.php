<?php

namespace Database\Factories;

use Domain\Event\Models\EventGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<EventGroup>
 */
class EventGroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<EventGroup>
     */
    protected $model = EventGroup::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(),
        ];
    }
}
