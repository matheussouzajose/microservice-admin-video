<?php

namespace App\Providers;

use App\Events\UserEventManager;
use App\Events\VideoEvent;
use App\Services\AMQP\AMQPInterface;
use App\Services\AMQP\PhpAmqpService;
use App\Services\Criptography\Hasher;
use App\Services\FileStorage\FileStorage;
use Core\Application\UseCases\Auth\Interfaces\UserEventManagerInterface;
use Core\Application\UseCases\Interfaces\FileStorageInterface;
use Core\Application\UseCases\Interfaces\HasherInterface;
use Core\Application\UseCases\Video\Interfaces\VideoEventManagerInterface;
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
