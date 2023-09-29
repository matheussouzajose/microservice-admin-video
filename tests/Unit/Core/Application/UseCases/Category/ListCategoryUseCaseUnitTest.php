<?php

namespace Tests\Unit\Core\Application\UseCases\Category;

use Core\Application\UseCases\Category\List\DTO\ListCategoryInputDto;
use Core\Application\UseCases\Category\List\DTO\ListCategoryOutputDto;
use Core\Application\UseCases\Category\List\ListCategoryUseCase;
use Core\Domain\Entity\Category;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\ValueObject\Uuid;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid as RamseyUuid;

class ListCategoryUseCaseUnitTest extends TestCase
{
    public function testListCategory()
    {
        $uuid = (string) RamseyUuid::uuid4();
        $categoryName = 'Category Name';
        $categoryCreatedAt = '2023-01-01 12:00:00';

        $category = \Mockery::mock(Category::class, [
            $categoryName, new Uuid($uuid),
        ]);

        $category->shouldReceive('id')->andReturn($uuid);
        $category->shouldReceive('createdAt')->once()->andReturn($categoryCreatedAt);

        $categoryRepository = \Mockery::mock(\stdClass::class, CategoryRepositoryInterface::class);
        $categoryRepository->shouldReceive('findById')->andReturn($category);

        $inputDto = \Mockery::mock(ListCategoryInputDto::class, [
            $uuid,
        ]);

        $listCategoryUseCase = new ListCategoryUseCase($categoryRepository);
        $responseUseCase = $listCategoryUseCase->execute($inputDto);

        $this->assertInstanceOf(ListCategoryOutputDto::class, $responseUseCase);
        $this->assertEquals($uuid, $responseUseCase->id);
        $this->assertEquals($categoryName, $responseUseCase->name);
        $this->assertEquals($categoryCreatedAt, $responseUseCase->created_at);
        $this->assertEmpty($responseUseCase->description);
    }

    protected function tearDown(): void
    {
        \Mockery::close();

        parent::tearDown();
    }
}
