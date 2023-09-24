<?php

namespace Tests\Feature\App\Http\Controllers\Api\Category;

use App\Http\Controllers\Api\Category\DeleteCategoryController;
use App\Models\Category;
use App\Repositories\Eloquent\CategoryEloquentRepository;
use Core\Data\UseCases\Category\Delete\DeleteCategoryUseCase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class DeleteCategoryControllerFeatureTest extends TestCase
{
    protected CategoryEloquentRepository $repository;

    protected function setUp(): void
    {
        $this->repository = new CategoryEloquentRepository(
            model: new Category()
        );

        parent::setUp();
    }

    public function testDelete()
    {
        $category = Category::factory()->create();
        $useCase = new DeleteCategoryUseCase(
            categoryRepository: $this->repository
        );

        $response = (new DeleteCategoryController($useCase))(
            id: $category->id
        );

        $this->assertEquals(Response::HTTP_NO_CONTENT, $response->status());
    }
}
