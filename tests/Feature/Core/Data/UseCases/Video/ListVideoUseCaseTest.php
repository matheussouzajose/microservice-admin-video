<?php

namespace Feature\Core\Data\UseCases\Video;

use App\Models\Video;
use Core\Data\UseCases\Video\List\DTO\ListVideoInputDto;
use Core\Data\UseCases\Video\List\ListVideoUseCase;
use Core\Domain\Exception\NotFoundException;
use Core\Domain\Repository\VideoRepositoryInterface;
use Tests\TestCase;

class ListVideoUseCaseTest extends TestCase
{
    public function test_list()
    {
        $video = Video::factory()->create();

        $useCase = new ListVideoUseCase(
            $this->app->make(VideoRepositoryInterface::class)
        );

        $response = $useCase->execute(new ListVideoInputDto(
            id: $video->id
        ));

        $this->assertNotNull($response);
        $this->assertEquals($video->id, $response->id);
    }

    public function test_exception()
    {
        $this->expectException(NotFoundException::class);

        $useCase = new ListVideoUseCase(
            $this->app->make(VideoRepositoryInterface::class)
        );

        $useCase->execute(new ListVideoInputDto(
            id: 'fake_id'
        ));
    }
}
