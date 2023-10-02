<?php

namespace Tests\Unit\Core\Application\UseCases\Category;

use Core\Application\UseCases\Category\UpdateCategoryUseCase;
use Core\Domain\Entity\Category;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\ValueObject\Uuid;
use Core\Intermediate\Dtos\Category\UpdateCategoryInputDto;
use Core\Intermediate\Dtos\Category\UpdateCategoryOutputDto;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid as RamseyUuid;

class UpdateCategoryUseCaseUnitTest extends TestCase
{
    public function testRenameCategory()
    {
        $uuid = (string) RamseyUuid::uuid4();
        $categoryName = 'Category Name';
        $categoryDesc = 'Category Description';

        $category = \Mockery::mock(Category::class, [
            $categoryName, new Uuid($uuid), $categoryDesc,
        ]);

        $category->shouldReceive('update');
        $category->shouldReceive('createdAt')->andReturn(date('Y-m-d H:i:s'));

        $categoryRepository = \Mockery::mock(\stdClass::class, CategoryRepositoryInterface::class);
        $categoryRepository->shouldReceive('findById')->once()->andReturn($category);
        $categoryRepository->shouldReceive('update')->once()->andReturn($category);

        $inputDto = \Mockery::mock(UpdateCategoryInputDto::class, [
            $uuid, 'New Name',
        ]);

        $updateCategoryUseCase = new UpdateCategoryUseCase($categoryRepository);
        $responseUseCase = $updateCategoryUseCase->execute($inputDto);

        $this->assertInstanceOf(UpdateCategoryOutputDto::class, $responseUseCase);
    }

    protected function tearDown(): void
    {
        \Mockery::close();

        parent::tearDown();
    }
}
