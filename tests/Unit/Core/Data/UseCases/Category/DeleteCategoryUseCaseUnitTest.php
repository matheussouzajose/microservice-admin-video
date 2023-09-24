<?php

namespace Tests\Unit\Core\Data\UseCases\Category;

use Core\Data\UseCases\Category\Delete\DeleteCategoryUseCase;
use Core\Data\UseCases\Category\Delete\DTO\DeleteCategoryInputDto;
use Core\Data\UseCases\Category\Delete\DTO\DeleteCategoryOutputDto;
use Core\Data\UseCases\Category\List\DTO\ListCategoryInputDto;
use Core\Domain\Repository\CategoryRepositoryInterface;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class DeleteCategoryUseCaseUnitTest extends TestCase
{
    public function testDelete()
    {
        $categoryRepository = \Mockery::mock(\stdClass::class, CategoryRepositoryInterface::class);
        $categoryRepository->shouldReceive('delete')->once()->andReturn(true);

        $inputDto = \Mockery::mock(DeleteCategoryInputDto ::class, [Uuid::uuid4()->toString()]);

        $deleteCategoryUseCase = new DeleteCategoryUseCase($categoryRepository);
        $responseUseCase = $deleteCategoryUseCase->execute($inputDto);

        $this->assertInstanceOf(DeleteCategoryOutputDto::class, $responseUseCase);
    }

    public function testDeleteFalse()
    {
        $categoryRepository = \Mockery::mock(\stdClass::class, CategoryRepositoryInterface::class);
        $categoryRepository->shouldReceive('delete')->once()->andReturn(false);

        $inputDto = \Mockery::mock(DeleteCategoryInputDto ::class, [Uuid::uuid4()->toString()]);

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
