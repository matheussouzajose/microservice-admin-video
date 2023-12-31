<?php

namespace Tests\Unit\Core\Application\UseCases\Genre;

use Core\Application\UseCases\Genre\ListGenreUseCase;
use Core\Domain\Entity\Genre as EntityGenre;
use Core\Domain\Repository\GenreRepositoryInterface;
use Core\Domain\ValueObject\Uuid as ValueObjectUuid;
use Core\Intermediate\Dtos\Genre\ListGenreInputDto;
use Core\Intermediate\Dtos\Genre\ListGenreOutputDto;
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
