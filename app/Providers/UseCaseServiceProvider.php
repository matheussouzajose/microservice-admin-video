<?php

namespace App\Providers;

use Core\Application\UseCases\Auth\LogoutUseCase;
use Core\Application\UseCases\Auth\SignInUseCase;
use Core\Application\UseCases\Auth\SignUpUseCase;
use Core\Application\UseCases\CastMember\CreateCastMemberUseCase;
use Core\Application\UseCases\CastMember\DeleteCastMemberUseCase;
use Core\Application\UseCases\CastMember\ListCastMemberUseCase;
use Core\Application\UseCases\CastMember\PaginateCastMembersUseCase;
use Core\Application\UseCases\CastMember\UpdateCastMemberUseCase;
use Core\Application\UseCases\Category\CreateCategoryUseCase;
use Core\Application\UseCases\Category\DeleteCategoryUseCase;
use Core\Application\UseCases\Category\ListCategoryUseCase;
use Core\Application\UseCases\Category\PaginateCategoriesUseCase;
use Core\Application\UseCases\Category\UpdateCategoryUseCase;
use Core\Application\UseCases\Genre\CreateGenreUseCase;
use Core\Application\UseCases\Genre\DeleteGenreUseCase;
use Core\Application\UseCases\Genre\ListGenreUseCase;
use Core\Application\UseCases\Genre\PaginateGenresUseCase;
use Core\Application\UseCases\Genre\UpdateGenreUseCase;
use Core\Application\UseCases\Video\CreateVideoUseCase;
use Core\Application\UseCases\Video\DeleteVideoUseCase;
use Core\Application\UseCases\Video\ListVideoUseCase;
use Core\Application\UseCases\Video\PaginateVideosUseCase;
use Core\Application\UseCases\Video\UpdateVideoUseCase;
use Core\Domain\UseCases\Auth\LogoutUseCaseInterface;
use Core\Domain\UseCases\Auth\SignInUseCaseInterface;
use Core\Domain\UseCases\Auth\SignUpUseCaseInterface;
use Core\Domain\UseCases\CastMember\CreateCastMemberUseCaseInterface;
use Core\Domain\UseCases\CastMember\DeleteCastMemberUseCaseInterface;
use Core\Domain\UseCases\CastMember\ListCastMemberUseCaseInterface;
use Core\Domain\UseCases\CastMember\PaginateCastMembersUseCaseInterface;
use Core\Domain\UseCases\CastMember\UpdateCastMemberUseCaseInterface;
use Core\Domain\UseCases\Category\CreateCategoryUseCaseInterface;
use Core\Domain\UseCases\Category\DeleteCategoryUseCaseInterface;
use Core\Domain\UseCases\Category\ListCategoryUseCaseInterface;
use Core\Domain\UseCases\Category\PaginateCategoriesUseCaseInterface;
use Core\Domain\UseCases\Category\UpdateCategoryUseCaseInterface;
use Core\Domain\UseCases\Genre\CreateGenreUseCaseInterface;
use Core\Domain\UseCases\Genre\DeleteGenreUseCaseInterface;
use Core\Domain\UseCases\Genre\ListGenreUseCaseInterface;
use Core\Domain\UseCases\Genre\PaginateGenresUseCaseInterface;
use Core\Domain\UseCases\Genre\UpdateGenreUseCaseInterface;
use Core\Domain\UseCases\Video\CreateVideoUseCaseInterface;
use Core\Domain\UseCases\Video\DeleteVideoUseCaseInterface;
use Core\Domain\UseCases\Video\ListVideoUseCaseInterface;
use Core\Domain\UseCases\Video\PaginateVideosUseCaseInterface;
use Core\Domain\UseCases\Video\UpdateVideoUseCaseInterface;
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

        $this->app->singleton(SignUpUseCaseInterface::class, SignUpUseCase::class);
        $this->app->singleton(SignInUseCaseInterface::class, SignInUseCase::class);
        $this->app->singleton(LogoutUseCaseInterface::class, LogoutUseCase::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
