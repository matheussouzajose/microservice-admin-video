<?php

namespace App\Providers;

use Core\Application\UseCases\CastMember\Create\CreateCastMemberUseCase;
use Core\Application\UseCases\CastMember\Create\CreateCastMemberUseCaseInterface;
use Core\Application\UseCases\CastMember\Delete\DeleteCastMemberUseCase;
use Core\Application\UseCases\CastMember\Delete\DeleteCastMemberUseCaseInterface;
use Core\Application\UseCases\CastMember\List\ListCastMemberUseCase;
use Core\Application\UseCases\CastMember\List\ListCastMemberUseCaseInterface;
use Core\Application\UseCases\CastMember\Paginate\PaginateCastMembersUseCase;
use Core\Application\UseCases\CastMember\Paginate\PaginateCastMembersUseCaseInterface;
use Core\Application\UseCases\CastMember\Update\UpdateCastMemberUseCase;
use Core\Application\UseCases\CastMember\Update\UpdateCastMemberUseCaseInterface;
use Core\Application\UseCases\Category\Create\CreateCategoryUseCase;
use Core\Application\UseCases\Category\Create\CreateCategoryUseCaseInterface;
use Core\Application\UseCases\Category\Delete\DeleteCategoryUseCase;
use Core\Application\UseCases\Category\Delete\DeleteCategoryUseCaseInterface;
use Core\Application\UseCases\Category\List\ListCategoryUseCase;
use Core\Application\UseCases\Category\List\ListCategoryUseCaseInterface;
use Core\Application\UseCases\Category\Paginate\PaginateCategoriesUseCase;
use Core\Application\UseCases\Category\Paginate\PaginateCategoriesUseCaseInterface;
use Core\Application\UseCases\Category\Update\UpdateCategoryUseCase;
use Core\Application\UseCases\Category\Update\UpdateCategoryUseCaseInterface;
use Core\Application\UseCases\Genre\Create\CreateGenreUseCase;
use Core\Application\UseCases\Genre\Create\CreateGenreUseCaseInterface;
use Core\Application\UseCases\Genre\Delete\DeleteGenreUseCase;
use Core\Application\UseCases\Genre\Delete\DeleteGenreUseCaseInterface;
use Core\Application\UseCases\Genre\List\ListGenreUseCase;
use Core\Application\UseCases\Genre\List\ListGenreUseCaseInterface;
use Core\Application\UseCases\Genre\Paginate\PaginateGenresUseCase;
use Core\Application\UseCases\Genre\Paginate\PaginateGenresUseCaseInterface;
use Core\Application\UseCases\Genre\Update\UpdateGenreUseCase;
use Core\Application\UseCases\Genre\Update\UpdateGenreUseCaseInterface;
use Core\Application\UseCases\Video\Create\CreateVideoUseCase;
use Core\Application\UseCases\Video\Create\CreateVideoUseCaseInterface;
use Core\Application\UseCases\Video\Delete\DeleteVideoUseCase;
use Core\Application\UseCases\Video\Delete\DeleteVideoUseCaseInterface;
use Core\Application\UseCases\Video\List\ListVideoUseCase;
use Core\Application\UseCases\Video\List\ListVideoUseCaseInterface;
use Core\Application\UseCases\Video\Paginate\PaginateVideosUseCase;
use Core\Application\UseCases\Video\Paginate\PaginateVideosUseCaseInterface;
use Core\Application\UseCases\Video\Update\UpdateVideoUseCase;
use Core\Application\UseCases\Video\Update\UpdateVideoUseCaseInterface;
use Illuminate\Support\ServiceProvider;

class UseCaseServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CreateCategoryUseCaseInterface::class, CreateCategoryUseCase::class);
        $this->app->singleton(DeleteCategoryUseCaseInterface::class, DeleteCategoryUseCase::class);
        $this->app->singleton(ListCategoryUseCaseInterface::class, ListCategoryUseCase::class);
        $this->app->singleton(PaginateCategoriesUseCaseInterface::class, PaginateCategoriesUseCase::class);
        $this->app->singleton(UpdateCategoryUseCaseInterface::class, UpdateCategoryUseCase::class);

        $this->app->singleton(CreateGenreUseCaseInterface::class, CreateGenreUseCase::class);
        $this->app->singleton(DeleteGenreUseCaseInterface::class, DeleteGenreUseCase::class);
        $this->app->singleton(ListGenreUseCaseInterface::class, ListGenreUseCase::class);
        $this->app->singleton(PaginateGenresUseCaseInterface::class, PaginateGenresUseCase::class);
        $this->app->singleton(UpdateGenreUseCaseInterface::class, UpdateGenreUseCase::class);

        $this->app->singleton(CreateCastMemberUseCaseInterface::class, CreateCastMemberUseCase::class);
        $this->app->singleton(DeleteCastMemberUseCaseInterface::class, DeleteCastMemberUseCase::class);
        $this->app->singleton(ListCastMemberUseCaseInterface::class, ListCastMemberUseCase::class);
        $this->app->singleton(PaginateCastMembersUseCaseInterface::class, PaginateCastMembersUseCase::class);
        $this->app->singleton(UpdateCastMemberUseCaseInterface::class, UpdateCastMemberUseCase::class);

        $this->app->singleton(CreateVideoUseCaseInterface::class, CreateVideoUseCase::class);
        $this->app->singleton(DeleteVideoUseCaseInterface::class, DeleteVideoUseCase::class);
        $this->app->singleton(ListVideoUseCaseInterface::class, ListVideoUseCase::class);
        $this->app->singleton(PaginateVideosUseCaseInterface::class, PaginateVideosUseCase::class);
        $this->app->singleton(UpdateVideoUseCaseInterface::class, UpdateVideoUseCase::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
