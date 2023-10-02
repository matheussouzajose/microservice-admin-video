<?php

namespace Tests\Unit\Core\Application\UseCases\Category;

use Core\Application\UseCases\Category\DeleteCategoryUseCase;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Intermediate\Dtos\Category\DeleteCategoryInputDto;
use Core\Intermediate\Dtos\Category\DeleteCategoryOutputDto;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class DeleteCategoryUseCaseUnitTest extends TestCase
{
    public function testDelete()
    {
        $categoryRepository = \Mockery::mock(\stdClass::class, CategoryRepositoryInterface::class);
        $categoryRepository->shouldReceive('delete')->once()->andReturn(true);

        $inputDto = \Mockery::mock(DeleteCategoryInputDto::class, [Uuid::uuid4()->toString()]);

        $deleteCategoryUseCase = new DeleteCategoryUseCase($categoryRepository);
        $responseUseCase = $deleteCategoryUseCase->execute($inputDto);

        $this->assertInstanceOf(DeleteCategoryOutputDto::class, $responseUseCase);
    }

    public function testDeleteFalse()
    {
        $categoryRepository = \Mockery::mock(\stdClass::class, CategoryRepositoryInterface::class);
        $categoryRepository->shouldReceive('delete')->once()->andReturn(false);

        $inputDto = \Mockery::mock(DeleteCategoryInputDto::class, [Uuid::uuid4()->toString()]);

        $deleteCategoryUseCase = new DeleteCategoryUseCase($categoryRepository);
        $responseUseCase = $deleteCategoryUseCase->execute($inputDto);

        $this->assertInstanceOf(DeleteCategoryOutputDto::class, $responseUseCase);
        $this->assertFalse($responseUseCase->success);
    }

    protected function tearDown(): void
    {
        \Mockery::close();

        parent::tearDown();
    }
}
