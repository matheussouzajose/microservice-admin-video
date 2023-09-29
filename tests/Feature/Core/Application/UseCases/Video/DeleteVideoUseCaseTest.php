<?php

namespace Feature\Core\Application\UseCases\Video;

use App\Models\Video;
use Core\Application\UseCases\Video\Delete\DeleteVideoUseCase;
use Core\Application\UseCases\Video\Delete\DTO\DeleteVideoInputDto;
use Core\Domain\Exception\NotFoundException;
use Core\Domain\Repository\VideoRepositoryInterface;
use Tests\TestCase;

class DeleteVideoUseCaseTest extends TestCase
{
    public function test_delete()
    {
        $video = Video::factory()->create();

        $useCase = new DeleteVideoUseCase(
            $this->app->make(VideoRepositoryInterface::class)
        );

        $response = $useCase->execute(new DeleteVideoInputDto(
            id: $video->id
        ));

        $this->assertTrue($response->deleted);
    }

    public function test_delete_id_not_found()
    {
        $this->expectException(NotFoundException::class);

        $useCase = new DeleteVideoUseCase(
            $this->app->make(VideoRepositoryInterface::class)
        );

        $useCase->execute(new DeleteVideoInputDto(
            id: 'fake_id'
        ));
    }
}
