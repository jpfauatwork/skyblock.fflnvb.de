<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Domain\Authentication\Models\User;
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
        User::factory()->create([
            'name' => env('ADMIN_USER_NAME'),
            'email' => env('ADMIN_USER_EMAIL'),
            'password' => bcrypt(env('ADMIN_USER_PASSWORD')),
        ]);

        $player = Player::factory()->create([
            'name' => env('SEEDER_PLAYER_NAME'),
        ]);

        Subscription::factory()->create([
            'event_name' => EventNames::PLAYER_LEFT,
            'context_player_id' => $player->id,
            'context_player_name' => env('SEEDER_PLAYER_NAME'),
            'via_telegram' => env('SEEDER_SUBSCRIPTION_TELEGRAM_ID'),
        ]);

        $this->call([
            EventSeeder::class,
        ]);
    }
}
