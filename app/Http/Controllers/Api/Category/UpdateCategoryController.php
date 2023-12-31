<?php

namespace App\Http\Controllers\Api\Category;

use App\Adapters\ApiAdapter;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCategoryRequest;
use Core\Domain\UseCases\Category\UpdateCategoryUseCaseInterface;
use Core\Intermediate\Dtos\Category\UpdateCategoryInputDto;
use Illuminate\Http\JsonResponse;

class UpdateCategoryController extends Controller
{
    public function __construct(private readonly UpdateCategoryUseCaseInterface $useCase)
    {
    }

    public function __invoke(UpdateCategoryRequest $request, string $id): JsonResponse
    {
        $response = $this->useCase->execute(
            input: new UpdateCategoryInputDto(
                id: $id,
                name: $request->name,
            )
        );

        return ApiAdapter::json($response);
    }
}
