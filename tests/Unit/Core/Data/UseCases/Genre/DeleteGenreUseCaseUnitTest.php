<?php

namespace Tests\Unit\Core\Data\UseCases\Genre;

use Core\Data\UseCases\Genre\Delete\DeleteGenreUseCase;
use Core\Data\UseCases\Genre\Delete\DTO\DeleteGenreOutputDto;
use Core\Data\UseCases\Genre\List\DTO\ListGenreInputDto;
use Core\Domain\Repository\GenreRepositoryInterface;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid as RamseyUuid;

class DeleteGenreUseCaseUnitTest extends TestCase
{
    public function testDelete()
    {
        $uuid = (string) RamseyUuid::uuid4();

        $mockRepository = \Mockery::mock(\stdClass::class, GenreRepositoryInterface::class);

        $mockRepository->shouldReceive('delete')
            ->once()
            ->with($uuid)
            ->andReturn(true);

        $mockInputDto = \Mockery::mock(ListGenreInputDto::class, [$uuid]);

        $useCase = new DeleteGenreUseCase($mockRepository);

        $response = $useCase->execute($mockInputDto);

        $this->assertInstanceOf(DeleteGenreOutputDto::class, $response);
        $this->assertTrue($response->success);
    }

    public function testDeleteFail()
    {
        $uuid = (string) RamseyUuid::uuid4();

        $mockRepository = \Mockery::mock(\stdClass::class, GenreRepositoryInterface::class);
        $mockRepository->shouldReceive('delete')
            ->times(1)
            ->with($uuid)
            ->andReturn(false);

        $mockInputDto = \Mockery::mock(ListGenreInputDto::class, [$uuid]);

        $useCase = new DeleteGenreUseCase($mockRepository);
        $response = $useCase->execute($mockInputDto);

        $this->assertFalse($response->success);
    }

    protected function tearDown(): void
    {
        \Mockery::close();

        parent::tearDown();
    }
}
