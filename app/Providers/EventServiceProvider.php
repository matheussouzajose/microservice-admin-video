<?php

namespace App\Providers;

use App\Listeners\SendEmailUserRegistered;
use App\Listeners\SendVideoToMicroEncoder;
use Core\Domain\Event\UserCreatedEvent;
use Core\Domain\Event\VideoCreatedEvent;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(
            VideoCreatedEvent::class,
            [SendVideoToMicroEncoder::class, 'handle']
        );

        Event::listen(
            UserCreatedEvent::class,
            [SendEmailUserRegistered::class, 'handle']
        );
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }

    public function register(): void
    {

    }
}
