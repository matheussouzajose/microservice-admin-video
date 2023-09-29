<?php

namespace Tests\Unit\Core\Application\UseCases\Video;

use Core\Application\UseCases\Video\ChangeEncoded\ChangeEncodedPathVideoUseCase;
use Core\Application\UseCases\Video\ChangeEncoded\DTO\ChangeEncodedVideoInputDto;
use Core\Application\UseCases\Video\ChangeEncoded\DTO\ChangeEncodedVideoOutputDto;
use Core\Domain\Entity\Video;
use Core\Domain\Enum\Rating;
use Core\Domain\Exception\NotFoundException;
use Core\Domain\Repository\VideoRepositoryInterface;
use Tests\TestCase;

class ChangeEncodedPathVideoUnitTest extends TestCase
{
    public function testSpies()
    {
        $input = new ChangeEncodedVideoInputDto(
            id: 'id-video',
            encodedPath: 'path/video_encoded.ext',
        );

        $mockRepository = \Mockery::mock(\stdClass::class, VideoRepositoryInterface::class);
        $mockRepository->shouldReceive('findById')
            ->times(1)
            ->with($input->id)
            ->andReturn($this->getEntity());
        $mockRepository->shouldReceive('updateMedia')
            ->times(1);

        $useCase = new ChangeEncodedPathVideoUseCase(
            repository: $mockRepository
        );

        $response = $useCase->execute(input: $input);

        $this->assertInstanceOf(ChangeEncodedVideoOutputDto::class, $response);

        \Mockery::close();
    }

    public function testExceptionRepository()
    {
        $this->expectException(NotFoundException::class);

        $input = new ChangeEncodedVideoInputDto(
            id: 'id-video',
            encodedPath: 'path/video_encoded.ext',
        );

        $mockRepository = \Mockery::mock(\stdClass::class, VideoRepositoryInterface::class);
        $mockRepository->shouldReceive('findById')
            ->times(1)
            ->with($input->id)
            ->andThrow(new NotFoundException('Not Found Video'));
        $mockRepository->shouldReceive('updateMedia')
            ->times(0);

        $useCase = new ChangeEncodedPathVideoUseCase(
            repository: $mockRepository
        );

        $response = $useCase->execute(
            input: $input
        );

        \Mockery::close();
    }

    private function getEntity(): Video
    {
        return new Video(
            title: 'title',
            description: 'desc',
            yearLaunched: 2026,
            duration: 1,
            opened: true,
            rating: Rating::L
        );
    }
}
