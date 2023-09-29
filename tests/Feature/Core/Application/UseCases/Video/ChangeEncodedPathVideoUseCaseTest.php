<?php

namespace Feature\Core\Application\UseCases\Video;

use App\Models\Video;
use Core\Application\UseCases\Video\ChangeEncoded\ChangeEncodedPathVideoUseCase;
use Core\Application\UseCases\Video\ChangeEncoded\DTO\ChangeEncodedVideoInputDto;
use Core\Domain\Repository\VideoRepositoryInterface;
use Tests\TestCase;

class ChangeEncodedPathVideoUseCaseTest extends TestCase
{
    public function testIfUpdatedMediaInDatabase()
    {
        $video = Video::factory()->create();

        $useCase = new ChangeEncodedPathVideoUseCase(
            $this->app->make(VideoRepositoryInterface::class)
        );

        $input = new ChangeEncodedVideoInputDto(
            id: $video->id,
            encodedPath: 'path-id/video_encoded.ext',
        );

        $useCase->execute($input);

        $this->assertDatabaseHas('medias_video', [
            'video_id' => $input->id,
            'encoded_path' => $input->encodedPath,
        ]);
    }
}
