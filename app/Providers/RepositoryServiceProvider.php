<?php

namespace App\Providers;

use App\Repositories\Eloquent\AuthEloquentRepository;
use App\Repositories\Eloquent\CastMemberEloquentRepository;
use App\Repositories\Eloquent\CategoryEloquentRepository;
use App\Repositories\Eloquent\GenreEloquentRepository;
use App\Repositories\Eloquent\VideoEloquentRepository;
use App\Repositories\Transaction\DBTransaction;
use Core\Domain\Repository\AuthRepositoryInterface;
use Core\Domain\Repository\CastMemberRepositoryInterface;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\Repository\GenreRepositoryInterface;
use Core\Domain\Repository\TransactionInterface;
use Core\Domain\Repository\VideoRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CategoryRepositoryInterface::class, CategoryEloquentRepository::class);
        $this->app->singleton(GenreRepositoryInterface::class, GenreEloquentRepository::class);
        $this->app->singleton(CastMemberRepositoryInterface::class, CastMemberEloquentRepository::class);
        $this->app->singleton(VideoRepositoryInterface::class, VideoEloquentRepository::class);
        $this->app->singleton(TransactionInterface::class, DBTransaction::class);
        $this->app->singleton(AuthRepositoryInterface::class, AuthEloquentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
