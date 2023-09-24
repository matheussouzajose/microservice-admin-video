<?php

namespace App\Http\Controllers\Api\Category;

use App\Adapters\ApiAdapter;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCategoryRequest;
use Core\Data\UseCases\Category\Update\DTO\UpdateCategoryInputDto;
use Core\Data\UseCases\Category\Update\UpdateCategoryUseCaseInterface;
use Illuminate\Http\JsonResponse;

class UpdateCategoryController extends Controller
{
    /**
     * @param UpdateCategoryUseCaseInterface $useCase
     */
    public function __construct(private readonly UpdateCategoryUseCaseInterface $useCase)
    {
    }

    /**
     * @param UpdateCategoryRequest $request
     * @param string $id
     * @return JsonResponse
     */
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