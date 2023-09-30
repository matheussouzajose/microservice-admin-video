<?php

namespace Tests\Feature\App\Http\Controllers\Api\Category;

use App\Http\Controllers\Api\Category\UpdateCategoryController;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Repositories\Eloquent\CategoryEloquentRepository;
use Core\Application\UseCases\Category\UpdateCategoryUseCase;
use Core\Domain\Exception\EntityValidationException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UpdateCategoryControllerFeatureTest extends TestCase
{
    protected CategoryEloquentRepository $repository;

    protected function setUp(): void
    {
        $this->repository = new CategoryEloquentRepository(
            model: new Category()
        );

        parent::setUp();
    }

    /**
     * @throws EntityValidationException
     */
    public function testUpdate()
    {
        $category = Category::factory()->create();

        $request = new UpdateCategoryRequest();
        $request->headers->set('content-type', 'application/json');
        $request->setJson(new ParameterBag([
            'name' => 'Updated',
        ]));
        $useCase = new UpdateCategoryUseCase($this->repository);
        $response = (new UpdateCategoryController($useCase))(
            request: $request,
            id: $category->id
        );

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->status());
        $this->assertDatabaseHas('categories', [
            'name' => 'Updated',
        ]);
    }
}
