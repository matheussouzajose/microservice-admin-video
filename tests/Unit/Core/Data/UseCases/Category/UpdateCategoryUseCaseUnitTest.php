<?php

namespace Tests\Unit\Core\Data\UseCases\Category;

use Core\Data\UseCases\Category\Update\DTO\UpdateCategoryInputDto;
use Core\Data\UseCases\Category\Update\DTO\UpdateCategoryOutputDto;
use Core\Data\UseCases\Category\Update\UpdateCategoryUseCase;
use Core\Domain\Entity\Category;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\ValueObject\Uuid;
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
            $categoryName, new Uuid($uuid), $categoryDesc
        ]);

        $category->shouldReceive('update');
        $category->shouldReceive('createdAt')->andReturn(date('Y-m-d H:i:s'));

        $categoryRepository = \Mockery::mock(\stdClass::class, CategoryRepositoryInterface::class);
        $categoryRepository->shouldReceive('findById')->once()->andReturn($category);
        $categoryRepository->shouldReceive('update')->once()->andReturn($category);

        $inputDto = \Mockery::mock(UpdateCategoryInputDto::class, [
            $uuid, 'New Name'
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
