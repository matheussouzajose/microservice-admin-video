<?php

namespace Unit\Core\Data\UseCases\Video;

use Core\Data\UseCases\Video\List\DTO\ListVideoInputDto;
use Core\Data\UseCases\Video\List\DTO\ListVideoOutputDto;
use Core\Data\UseCases\Video\List\ListVideoUseCase;
use Core\Domain\Entity\Video;
use Core\Domain\Enum\Rating;
use Core\Domain\Repository\VideoRepositoryInterface;
use Core\Domain\ValueObject\Uuid;
use Tests\TestCase;

class ListVideoUseCaseUnitTest extends TestCase
{
    public function test_list()
    {
        $uuid = Uuid::random();

        $useCase = new ListVideoUseCase(
            repository: $this->mockRepository()
        );

        $response = $useCase->execute(
            input: $this->mockInputDTO($uuid)
        );

        $this->assertInstanceOf(ListVideoOutputDto::class, $response);
    }

    private function mockInputDTO(string $id)
    {
        return \Mockery::mock(ListVideoInputDto::class, [
            $id,
        ]);
    }

    private function mockRepository()
    {
        $mockRepository = \Mockery::mock(\stdClass::class, VideoRepositoryInterface::class);
        $mockRepository->shouldReceive('findById')
            ->once()
            ->andReturn($this->getEntity());

        return $mockRepository;
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
