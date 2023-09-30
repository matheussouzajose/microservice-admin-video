<?php

namespace Feature\Core\Application\UseCases\Genre;

use App\Models\Genre as Model;
use App\Repositories\Eloquent\GenreEloquentRepository;
use Core\Application\UseCases\Genre\ListGenreUseCase;
use Core\Intermediate\Dtos\Genre\ListGenreInputDto;
use Tests\TestCase;

class ListGenreUseCaseTest extends TestCase
{
    public function testFindById()
    {
        $useCase = new ListGenreUseCase(
            new GenreEloquentRepository(new Model())
        );

        $genre = Model::factory()->create();

        $responseUseCase = $useCase->execute(new ListGenreInputDto(
            id: $genre->id
        ));

        $this->assertEquals($genre->id, $responseUseCase->id);
        $this->assertEquals($genre->name, $responseUseCase->name);
    }
}
