<?php

namespace Feature\Core\Application\UseCases\Genre;

use App\Models\Genre;
use App\Repositories\Eloquent\GenreEloquentRepository;
use Core\Application\UseCases\Genre\Paginate\DTO\PaginateGenresInputDto;
use Core\Application\UseCases\Genre\Paginate\PaginateGenresUseCase;
use Tests\TestCase;

class PaginateGenresUseCaseTest extends TestCase
{
    public function testFindAll()
    {
        $useCase = new PaginateGenresUseCase(
            new GenreEloquentRepository(new Genre())
        );

        Genre::factory()->count(100)->create();

        $responseUseCase = $useCase->execute(
            new PaginateGenresInputDto()
        );

        $this->assertEquals(15, count($responseUseCase->items()));
        $this->assertEquals(100, $responseUseCase->total());
    }
}
