<?php

namespace App\Providers;

use App\Events\VideoEvent;
use App\Services\AMQP\AMQPInterface;
use App\Services\AMQP\PhpAmqpService;
use App\Services\FileStorage\FileStorage;
use Core\Data\UseCases\Interfaces\FileStorageInterface;
use Core\Data\UseCases\Video\Interfaces\VideoEventManagerInterface;
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
        $this->app->singleton(VideoEventManagerInterface::class, VideoEvent::class);
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
