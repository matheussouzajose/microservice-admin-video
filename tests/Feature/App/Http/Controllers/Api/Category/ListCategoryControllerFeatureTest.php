<?php

namespace Tests\Feature\App\Http\Controllers\Api\Category;

use App\Http\Controllers\Api\Category\ListCategoryController;
use App\Models\Category;
use App\Repositories\Eloquent\CategoryEloquentRepository;
use Core\Application\UseCases\Category\ListCategoryUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ListCategoryControllerFeatureTest extends TestCase
{
    protected CategoryEloquentRepository $repository;

    protected function setUp(): void
    {
        $this->repository = new CategoryEloquentRepository(
            model: new Category()
        );

        parent::setUp();
    }

    public function testListCategory()
    {
        $category = Category::factory()->create();

        $useCase = new ListCategoryUseCase(
            categoryRepository: $this->repository
        );

        $response = (new ListCategoryController($useCase))(
            id: $category->id
        );

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->status());
    }
}
