<?php

namespace Tests\Feature\Core\Application\UseCases\Category;

use App\Models\Category as CategoryModel;
use App\Repositories\Eloquent\CategoryEloquentRepository;
use Core\Application\UseCases\Category\PaginateCategoriesUseCase;
use Core\Domain\Repository\PaginationInterface;
use Core\Intermediate\Dtos\Category\PaginateCategoriesInputDto;
use Tests\TestCase;

class PaginateCategoriesUseCaseFeatureTest extends TestCase
{
    public function testListCategoriesEmpty()
    {
        $response = $this->createUseCase();

        $this->assertCount(0, $response->items());
    }

    public function testListCategories()
    {
        CategoryModel::factory()->count(20)->create();

        $response = $this->createUseCase();

        $this->assertCount(15, $response->items());
        $this->assertEquals(20, $response->total());
    }

    private function createUseCase(): PaginationInterface
    {
        $model = new CategoryModel();
        $repository = new CategoryEloquentRepository($model);
        $useCase = new PaginateCategoriesUseCase($repository);

        return $useCase->execute(
            new PaginateCategoriesInputDto()
        );
    }
}
