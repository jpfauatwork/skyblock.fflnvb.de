<?php

namespace Database\Seeders;

use Domain\Rares\Enums\CollectibleTypeEnum;
use Domain\Rares\Models\Collectible;
use Domain\Rares\Models\Tag;
use Domain\Rares\Models\TagGroup;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $tagGroupHalloween = TagGroup::factory()->create([
            'name' => 'Halloween',
            'description' => 'Events around Halloween, October 31st.',
        ]);

        $tagHalloween2022 = Tag::factory()
            ->for($tagGroupHalloween)
            ->create([
                'name' => 'Halloween 2022',
                'description' => null,
                'occured_at' => '2022-10-31 20:00:00',
            ]);

        Collectible::factory()
            ->for($tagHalloween2022)
            ->create([
                'type' => CollectibleTypeEnum::HEAD,
                'name' => 'Candy Head',
                'amount' => 5,
            ]);

        $tagHalloween2023 = Tag::factory()
            ->for($tagGroupHalloween)
            ->create([
                'name' => 'Halloween 2023',
                'description' => null,
                'occured_at' => '2023-10-31 18:00:00',
            ]);

        Collectible::factory()
            ->for($tagHalloween2023)
            ->create([
                'type' => CollectibleTypeEnum::HEAD,
                'name' => 'Pumpkin',
                'amount' => 10,
                'collected_at' => '2023-10-31 18:30:00',
            ]);
    }
}
