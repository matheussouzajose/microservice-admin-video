<?php

namespace Feature\Core\Application\UseCases\Genre;

use App\Models\Genre as Model;
use App\Repositories\Eloquent\GenreEloquentRepository;
use Core\Application\UseCases\Genre\Delete\DeleteGenreUseCase;
use Core\Application\UseCases\Genre\List\DTO\ListGenreInputDto;
use Tests\TestCase;

class DeleteGenreUseCaseTest extends TestCase
{
    public function testDelete()
    {
        $useCase = new DeleteGenreUseCase(
            new GenreEloquentRepository(new Model())
        );

        $genre = Model::factory()->create();

        $responseUseCase = $useCase->execute(new ListGenreInputDto(
            id: $genre->id
        ));

        $this->assertTrue($responseUseCase->success);

        $this->assertSoftDeleted('genres', [
            'id' => $genre->id,
        ]);
    }
}
