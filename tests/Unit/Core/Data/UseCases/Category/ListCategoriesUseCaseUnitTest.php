<?php

namespace Tests\Unit\Core\Data\UseCases\Category;

use Core\Data\UseCases\Category\Paginate\DTO\PaginateCategoriesInputDto;
use Core\Data\UseCases\Category\Paginate\PaginateCategoriesUseCase;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\Repository\PaginationInterface;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Core\Data\UseCases\UseCaseTrait;

class ListCategoriesUseCaseUnitTest extends TestCase
{
    use UseCaseTrait;

    public function testListCategoriesEmpty()
    {
        $pagination = $this->mockPagination();

        $categoryRepository = \Mockery::mock(\stdClass::class, CategoryRepositoryInterface::class);
        $categoryRepository->shouldReceive('paginate')->andReturn($pagination);

        $inputDto = \Mockery::mock(PaginateCategoriesInputDto::class, ['filter', 'DESC']);

        $listCategoriesUseCase = new PaginateCategoriesUseCase($categoryRepository);
        $responseUseCase = $listCategoriesUseCase->execute($inputDto);

        $this->assertCount(0, $responseUseCase->items());
        $this->assertInstanceOf(PaginationInterface::class, $responseUseCase);

        /**
         * Spies
         */
        $categoryRepositorySpy = \Mockery::spy(\stdClass::class, CategoryRepositoryInterface::class);
        $categoryRepositorySpy->shouldReceive('paginate')->once()->andReturn($pagination);

        $createCategory = new PaginateCategoriesUseCase($categoryRepositorySpy);
        $createCategory->execute($inputDto);

        $categoryRepositorySpy->shouldHaveReceived('paginate');
    }

    public function testListCategoriesPaginate()
    {
        $stdClass = new \stdClass();
        $stdClass->id = 'uuid';
        $stdClass->name = 'name';
        $stdClass->description = 'description';
        $stdClass->isActive = 'isActive';
        $stdClass->createdAt = 'createdAt';
        $stdClass->updatedAt = 'createdAt';
        $stdClass->deletedAt = 'createdAt';

        $pagination = $this->mockPagination([
            $stdClass,
        ]);

        $categoryRepository = \Mockery::mock(\stdClass::class, CategoryRepositoryInterface::class);
        $categoryRepository->shouldReceive('paginate')->once()->andReturn($pagination);

        $inputDto = \Mockery::mock(PaginateCategoriesInputDto::class, ['filter', 'DESC']);

        $listCategoriesUseCase = new PaginateCategoriesUseCase($categoryRepository);
        $responseUseCase = $listCategoriesUseCase->execute($inputDto);

        $this->assertCount(1, $responseUseCase->items());
        $this->assertInstanceOf(PaginationInterface::class, $responseUseCase);
        $this->assertInstanceOf(\stdClass::class, $responseUseCase->items()[0]);
    }

    protected function tearDown(): void
    {
        \Mockery::close();

        parent::tearDown();
    }
}
