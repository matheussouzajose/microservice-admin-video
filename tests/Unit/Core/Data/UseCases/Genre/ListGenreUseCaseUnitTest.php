<?php

namespace Tests\Unit\Core\Data\UseCases\Genre;

use Core\Data\UseCases\Genre\List\DTO\ListGenreInputDto;
use Core\Data\UseCases\Genre\List\DTO\ListGenreOutputDto;
use Core\Data\UseCases\Genre\List\ListGenreUseCase;
use Core\Domain\Entity\Genre as EntityGenre;
use Core\Domain\Repository\GenreRepositoryInterface;
use Core\Domain\ValueObject\Uuid as ValueObjectUuid;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class ListGenreUseCaseUnitTest extends TestCase
{
    public function testListGenre()
    {
        $uuid = (string) Uuid::uuid4();

        $mockEntity = \Mockery::mock(EntityGenre::class, [
            'teste', new ValueObjectUuid($uuid), true, [],
        ]);
        $mockEntity->shouldReceive('createdAt')->andReturn(date('Y-m-d H:i:s'));

        $mockRepository = \Mockery::mock(\stdClass::class, GenreRepositoryInterface::class);
        $mockRepository->shouldReceive('findById')->once()->with($uuid)->andReturn($mockEntity);

        $mockInputDto = \Mockery::mock(ListGenreInputDto::class, [
            $uuid,
        ]);

        $useCase = new ListGenreUseCase($mockRepository);
        $response = $useCase->execute($mockInputDto);

        $this->assertInstanceOf(ListGenreOutputDto::class, $response);

        \Mockery::close();
    }
}
