<?php

namespace Tests\Feature\App\Http\Controllers\Api\Category;

use App\Http\Controllers\Api\Category\PaginateCategoriesController;
use App\Models\Category;
use App\Repositories\Eloquent\CategoryEloquentRepository;
use Core\Data\UseCases\Category\Paginate\PaginateCategoriesUseCase;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Tests\TestCase;

class ListCategoriesControllerFeatureTest extends TestCase
{
    protected CategoryEloquentRepository $repository;

    protected function setUp(): void
    {
        $this->repository = new CategoryEloquentRepository(
            model: new Category()
        );

        parent::setUp();
    }

    public function testListCategories()
    {
        $useCase = new PaginateCategoriesUseCase(
            categoryRepository: $this->repository
        );

        $response = (new PaginateCategoriesController($useCase))(
            request: new Request()
        );

        $this->assertInstanceOf(AnonymousResourceCollection::class, $response);
        $this->assertArrayHasKey('meta', $response->additional);
    }
}
