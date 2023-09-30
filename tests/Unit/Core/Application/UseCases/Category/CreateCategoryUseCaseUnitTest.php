<?php

namespace Tests\Unit\Core\Application\UseCases\Category;

use Core\Application\UseCases\Category\CreateCategoryUseCase;
use Core\Domain\Entity\Category;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\ValueObject\Uuid;
use Core\Intermediate\Dtos\Category\CreateCategoryInputDto;
use Core\Intermediate\Dtos\Category\CreateCategoryOutputDto;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid as RamseyUuid;

class CreateCategoryUseCaseUnitTest extends TestCase
{
    public function testCreateNewCategory()
    {
        $uuid = (string) RamseyUuid::uuid4();
        $categoryName = 'Category Name';

        $category = \Mockery::mock(Category::class, [
            $categoryName, new Uuid($uuid),
        ]);

        $category->shouldReceive('id')->andReturn($uuid);
        $category->shouldReceive('createdAt')->andReturn(date('Y-m-d h:i:s'));

        $categoryRepository = \Mockery::mock(\stdClass::class, CategoryRepositoryInterface::class);
        $categoryRepository->shouldReceive('insert')->once()->andReturn($category);

        $inputDto = \Mockery::mock(CreateCategoryInputDto::class, [
            $categoryName,
        ]);

        $createCategoryUseCase = new CreateCategoryUseCase($categoryRepository);
        $responseUseCase = $createCategoryUseCase->execute($inputDto);

        $this->assertInstanceOf(CreateCategoryOutputDto::class, $responseUseCase);
        $this->assertEquals($uuid, $responseUseCase->id);
        $this->assertEquals($categoryName, $responseUseCase->name);
        $this->assertEmpty($responseUseCase->description);
    }

    protected function tearDown(): void
    {
        \Mockery::close();

        parent::tearDown();
    }
}
