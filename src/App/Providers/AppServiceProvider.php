<?php

namespace App\Providers;

use Domain\Player\Events\NewPlayersDetectedEvent;
use Domain\Player\Listeners\NewPlayersDetectedListener;
use Domain\Player\Listeners\PlayersJoinedListener;
use Domain\Presence\Listeners\PlayersIdentifiedListener;
use Domain\Presence\Listeners\ServerScannedListener;
use Domain\Shared\Events\PlayersIdentifiedEvent;
use Domain\Shared\Events\PlayersJoinedEvent;
use Domain\Shared\Events\PlayersLeftEvent;
use Domain\Shared\Events\ServerScannedEvent;
use Domain\Subscription\Listeners\PlayersLeftListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Event::listen(
            ServerScannedEvent::class,
            ServerScannedListener::class
        );

        Event::listen(
            PlayersJoinedEvent::class,
            PlayersJoinedListener::class
        );

        Event::listen(
            PlayersLeftEvent::class,
            PlayersLeftListener::class
        );

        Event::listen(
            NewPlayersDetectedEvent::class,
            NewPlayersDetectedListener::class
        );

        Event::listen(
            PlayersIdentifiedEvent::class,
            PlayersIdentifiedListener::class
        );
    }
}
