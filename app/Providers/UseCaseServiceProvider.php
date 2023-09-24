<?php

namespace App\Providers;

use Core\Data\UseCases\CastMember\Create\CreateCastMemberUseCase;
use Core\Data\UseCases\CastMember\Create\CreateCastMemberUseCaseInterface;
use Core\Data\UseCases\CastMember\Delete\DeleteCastMemberUseCase;
use Core\Data\UseCases\CastMember\Delete\DeleteCastMemberUseCaseInterface;
use Core\Data\UseCases\CastMember\List\ListCastMemberUseCase;
use Core\Data\UseCases\CastMember\List\ListCastMemberUseCaseInterface;
use Core\Data\UseCases\CastMember\Paginate\PaginateCastMembersUseCase;
use Core\Data\UseCases\CastMember\Paginate\PaginateCastMembersUseCaseInterface;
use Core\Data\UseCases\CastMember\Update\UpdateCastMemberUseCase;
use Core\Data\UseCases\CastMember\Update\UpdateCastMemberUseCaseInterface;
use Core\Data\UseCases\Category\Create\CreateCategoryUseCase;
use Core\Data\UseCases\Category\Create\CreateCategoryUseCaseInterface;
use Core\Data\UseCases\Category\Delete\DeleteCategoryUseCase;
use Core\Data\UseCases\Category\Delete\DeleteCategoryUseCaseInterface;
use Core\Data\UseCases\Category\List\ListCategoryUseCase;
use Core\Data\UseCases\Category\List\ListCategoryUseCaseInterface;
use Core\Data\UseCases\Category\Paginate\PaginateCategoriesUseCase;
use Core\Data\UseCases\Category\Paginate\PaginateCategoriesUseCaseInterface;
use Core\Data\UseCases\Category\Update\UpdateCategoryUseCase;
use Core\Data\UseCases\Category\Update\UpdateCategoryUseCaseInterface;
use Core\Data\UseCases\Genre\Create\CreateGenreUseCase;
use Core\Data\UseCases\Genre\Create\CreateGenreUseCaseInterface;
use Core\Data\UseCases\Genre\Delete\DeleteGenreUseCase;
use Core\Data\UseCases\Genre\Delete\DeleteGenreUseCaseInterface;
use Core\Data\UseCases\Genre\List\ListGenreUseCase;
use Core\Data\UseCases\Genre\List\ListGenreUseCaseInterface;
use Core\Data\UseCases\Genre\Paginate\PaginateGenresUseCase;
use Core\Data\UseCases\Genre\Paginate\PaginateGenresUseCaseInterface;
use Core\Data\UseCases\Genre\Update\UpdateGenreUseCase;
use Core\Data\UseCases\Genre\Update\UpdateGenreUseCaseInterface;
use Core\Data\UseCases\Video\Create\CreateVideoUseCase;
use Core\Data\UseCases\Video\Create\CreateVideoUseCaseInterface;
use Core\Data\UseCases\Video\Delete\DeleteVideoUseCase;
use Core\Data\UseCases\Video\Delete\DeleteVideoUseCaseInterface;
use Core\Data\UseCases\Video\List\ListVideoUseCase;
use Core\Data\UseCases\Video\List\ListVideoUseCaseInterface;
use Core\Data\UseCases\Video\Paginate\PaginateVideosUseCase;
use Core\Data\UseCases\Video\Paginate\PaginateVideosUseCaseInterface;
use Core\Data\UseCases\Video\Update\UpdateVideoUseCase;
use Core\Data\UseCases\Video\Update\UpdateVideoUseCaseInterface;
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
