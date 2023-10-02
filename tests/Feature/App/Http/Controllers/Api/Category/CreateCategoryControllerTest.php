<?php

namespace Tests\Feature\App\Http\Controllers\Api\Category;

use App\Http\Controllers\Api\Category\CreateCategoryController;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Repositories\Eloquent\CategoryEloquentRepository;
use Core\Application\UseCases\Category\CreateCategoryUseCase;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CreateCategoryControllerTest extends TestCase
{
    protected CategoryEloquentRepository $repository;

    protected function setUp(): void
    {
        $this->repository = new CategoryEloquentRepository(
            model: new Category()
        );

        parent::setUp();
    }

    public function testCreate()
    {
        $useCase = new CreateCategoryUseCase(
            categoryRepository: $this->repository
        );

        $request = new StoreCategoryRequest();
        $request->headers->set('content-type', 'application/json');
        $request->setJson(new ParameterBag([
            'name' => 'Teste',
        ]));

        $response = (new CreateCategoryController($useCase))(
            request: $request
        );

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_CREATED, $response->status());
    }
}
