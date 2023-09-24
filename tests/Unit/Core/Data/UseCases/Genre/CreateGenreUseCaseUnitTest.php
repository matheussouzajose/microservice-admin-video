<?php

namespace Tests\Unit\Core\Data\UseCases\Genre;

use Core\Data\UseCases\Genre\Create\CreateGenreUseCase;
use Core\Data\UseCases\Genre\Create\DTO\CreateGenreInputDto;
use Core\Data\UseCases\Genre\Create\DTO\CreateGenreOutputDto;
use Core\Data\UseCases\Interfaces\TransactionInterface;
use Core\Domain\Entity\Genre as EntityGenre;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\Repository\GenreRepositoryInterface;
use Core\Domain\ValueObject\Uuid as ValueObjectUuid;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class CreateGenreUseCaseUnitTest extends TestCase
{
    public function testCreate()
    {
        $uuid = (string) Uuid::uuid4();

        $useCase = new CreateGenreUseCase($this->mockRepository($uuid), $this->mockTransaction(), $this->mockCategoryRepository($uuid));
        $response = $useCase->execute($this->mockCreateInputDto([$uuid]));

        $this->assertInstanceOf(CreateGenreOutputDto::class, $response);
    }

    private function mockEntity(string $uuid)
    {
        $mockEntity = \Mockery::mock(EntityGenre::class, [
            'teste', new ValueObjectUuid($uuid), true, [],
        ]);
        $mockEntity->shouldReceive('createdAt')->andReturn(date('Y-m-d H:i:s'));

        return $mockEntity;
    }

    private function mockRepository(string $uuid, int $timesCalled = 1)
    {
        $mockRepository = \Mockery::mock(\stdClass::class, GenreRepositoryInterface::class);
        $mockRepository->shouldReceive('insert')
            ->times($timesCalled)
            ->andReturn($this->mockEntity($uuid));

        return $mockRepository;
    }

    private function mockTransaction()
    {
        $mockTransaction = \Mockery::mock(\stdClass::class, TransactionInterface::class);
        $mockTransaction->shouldReceive('commit');
        $mockTransaction->shouldReceive('rollback');

        return $mockTransaction;
    }

    private function mockCategoryRepository(string $uuid)
    {
        $mockCategoryRepository = \Mockery::mock(\stdClass::class, CategoryRepositoryInterface::class);
        $mockCategoryRepository->shouldReceive('getIdsByEntitiesIds')->once()->andReturn([$uuid]);

        return $mockCategoryRepository;
    }

    private function mockCreateInputDto(array $categoriesIds)
    {
        return \Mockery::mock(CreateGenreInputDto::class, [
            'name', $categoriesIds, true,
        ]);
    }

    protected function tearDown(): void
    {
        \Mockery::close();

        parent::tearDown();
    }
}
