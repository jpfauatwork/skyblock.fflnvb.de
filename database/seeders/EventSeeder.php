<?php

namespace Database\Seeders;

use Domain\Rares\Enums\CollectibleTypeEnum;
use Domain\Rares\Models\Collectible;
use Domain\Rares\Models\Event;
use Domain\Rares\Models\EventGroup;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $eventGroupHalloween = EventGroup::factory()->create([
            'name' => 'Halloween',
            'description' => 'Events around Halloween, October 31st.',
        ]);

        $eventHalloween2022 = Event::factory()
            ->for($eventGroupHalloween)
            ->create([
                'name' => 'Halloween 2022',
                'description' => null,
                'occured_at' => '2022-10-31 20:00:00',
            ]);

        Collectible::factory()
            ->for($eventHalloween2022)
            ->create([
                'type' => CollectibleTypeEnum::HEAD,
                'name' => 'Candy Head',
                'amount' => 5,
            ]);

        $eventHalloween2023 = Event::factory()
            ->for($eventGroupHalloween)
            ->create([
                'name' => 'Halloween 2023',
                'description' => null,
                'occured_at' => '2023-10-31 18:00:00',
            ]);

        Collectible::factory()
            ->for($eventHalloween2023)
            ->create([
                'type' => CollectibleTypeEnum::HEAD,
                'name' => 'Pumpkin',
                'amount' => 10,
                'collected_at' => '2023-10-31 18:30:00',
            ]);
    }
}
