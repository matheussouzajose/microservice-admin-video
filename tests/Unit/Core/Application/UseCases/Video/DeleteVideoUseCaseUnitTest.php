<?php

namespace Unit\Core\Application\UseCases\Video;

use Core\Application\UseCases\Video\Delete\DeleteVideoUseCase;
use Core\Application\UseCases\Video\Delete\DTO\DeleteVideoInputDto;
use Core\Application\UseCases\Video\Delete\DTO\DeleteVideoOutputDto;
use Core\Domain\Repository\VideoRepositoryInterface;
use Core\Domain\ValueObject\Uuid;
use Tests\TestCase;

class DeleteVideoUseCaseUnitTest extends TestCase
{
    public function test_delete()
    {
        $useCase = new DeleteVideoUseCase(
            repository: $this->mockRepository()
        );

        $response = $useCase->execute(
            input: $this->mockInputDTO()
        );

        $this->assertInstanceOf(DeleteVideoOutputDto::class, $response);

        \Mockery::close();
    }

    private function mockRepository()
    {
        $mockRepository = \Mockery::mock(\stdClass::class, VideoRepositoryInterface::class);
        $mockRepository->shouldReceive('delete')
            ->once()
            ->andReturn(true);

        return $mockRepository;
    }

    private function mockInputDTO()
    {
        return \Mockery::mock(DeleteVideoInputDto::class, [
            Uuid::random(),
        ]);
    }
}
