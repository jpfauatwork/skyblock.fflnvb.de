<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Domain\Player\Models\Player;
use Domain\Subscription\Enums\EventNames;
use Domain\Subscription\Models\Subscription;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $player = Player::factory()->create([
            'name' => env('SEEDER_PLAYER_NAME'),
        ]);

        Subscription::factory()->create([
            'event_name' => EventNames::PLAYER_LEFT,
            'context_player_id' => $player->id,
            'context_player_name' => env('SEEDER_PLAYER_NAME'),
            'via_telegram' => env('SEEDER_SUBSCRIPTION_TELEGRAM_ID'),
        ]);
    }
}
