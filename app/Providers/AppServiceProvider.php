<?php

namespace App\Providers;

use App\Events\UserEventManager;
use App\Events\VideoEvent;
use App\Services\AMQP\PhpAmqpService;
use App\Services\Criptography\Hasher;
use App\Services\FileStorage\FileStorage;
use App\Services\Notifications\SendUserEmailVerification;
use Core\Domain\Event\Interfaces\UserEventManagerInterface;
use Core\Domain\Event\Interfaces\VideoEventManagerInterface;
use Core\Domain\Services\AMQPInterface;
use Core\Domain\Services\FileStorageInterface;
use Core\Domain\Services\HasherInterface;
use Core\Domain\Services\UserNotificationInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(FileStorageInterface::class, FileStorage::class);
        $this->app->singleton(AMQPInterface::class, PhpAmqpService::class);
        $this->app->singleton(HasherInterface::class, Hasher::class);
        $this->app->singleton(VideoEventManagerInterface::class, VideoEvent::class);
        $this->app->singleton(UserEventManagerInterface::class, UserEventManager::class);
        $this->app->singleton(UserNotificationInterface::class, SendUserEmailVerification::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
