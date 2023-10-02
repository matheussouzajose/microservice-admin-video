<?php

namespace Feature\Core\Application\UseCases\Genre;

use App\Models\Category as ModelCategory;
use App\Models\Genre as Model;
use App\Repositories\Eloquent\CategoryEloquentRepository;
use App\Repositories\Eloquent\GenreEloquentRepository;
use App\Repositories\Transaction\DBTransaction;
use Core\Application\UseCases\Genre\UpdateGenreUseCase;
use Core\Domain\Exception\NotFoundException;
use Core\Intermediate\Dtos\Genre\UpdateGenreInputDto;
use Tests\TestCase;

class UpdateGenreUseCaseTest extends TestCase
{
    public function testUpdate()
    {
        $repository = new GenreEloquentRepository(new Model());
        $repositoryCategory = new CategoryEloquentRepository(new ModelCategory());

        $useCase = new UpdateGenreUseCase(
            $repository,
            new DBTransaction(),
            $repositoryCategory
        );

        $genre = Model::factory()->create();

        $categories = ModelCategory::factory()->count(10)->create();
        $categoriesIds = $categories->pluck('id')->toArray();

        $useCase->execute(
            new UpdateGenreInputDto(
                id: $genre->id,
                name: 'New Name',
                categoriesId: $categoriesIds
            )
        );

        $this->assertDatabaseHas('genres', [
            'name' => 'New Name',
        ]);

        $this->assertDatabaseCount('category_genre', 10);
    }

    public function testExceptionUpdateGenreWithCategoriesIdsInvalid()
    {
        $this->expectException(NotFoundException::class);

        $repository = new GenreEloquentRepository(new Model());
        $repositoryCategory = new CategoryEloquentRepository(new ModelCategory());

        $useCase = new UpdateGenreUseCase(
            $repository,
            new DBTransaction(),
            $repositoryCategory
        );

        $genre = Model::factory()->create();

        $categories = ModelCategory::factory()->count(10)->create();
        $categoriesIds = $categories->pluck('id')->toArray();
        $categoriesIds[] = 'fake_id';

        $useCase->execute(
            new UpdateGenreInputDto(
                id: $genre->id,
                name: 'New Name',
                categoriesId: $categoriesIds
            )
        );
    }

    public function testTransactionUpdate()
    {
        $repository = new GenreEloquentRepository(new Model());
        $repositoryCategory = new CategoryEloquentRepository(new ModelCategory());

        $useCase = new UpdateGenreUseCase(
            $repository,
            new DBTransaction(),
            $repositoryCategory
        );

        $genre = Model::factory()->create();

        $categories = ModelCategory::factory()->count(10)->create();
        $categoriesIds = $categories->pluck('id')->toArray();

        try {
            $useCase->execute(
                new UpdateGenreInputDto(
                    id: $genre->id,
                    name: 'New Name',
                    categoriesId: $categoriesIds
                )
            );

            $this->assertDatabaseHas('genres', [
                'name' => 'New Name',
            ]);

            $this->assertDatabaseCount('category_genre', 10);
        } catch (\Throwable $th) {
            $this->assertDatabaseCount('genres', 0);
            $this->assertDatabaseCount('category_genre', 0);
        }
    }
}
