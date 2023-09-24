<?php

namespace App\Http\Controllers\Api\Category;

use App\Adapters\ApiAdapter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use Core\Data\UseCases\Category\Create\CreateCategoryUseCaseInterface;
use Core\Data\UseCases\Category\Create\DTO\CreateCategoryInputDto;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreateCategoryController extends Controller
{
    /**
     * @param CreateCategoryUseCaseInterface $useCase
     */
    public function __construct(private readonly CreateCategoryUseCaseInterface $useCase)
    {
    }

    /**
     * @param StoreCategoryRequest $request
     * @return JsonResponse
     */
    public function __invoke(StoreCategoryRequest $request): JsonResponse
    {
        $response = $this->useCase->execute(
            input: new CreateCategoryInputDto(
                name: $request->name,
                description: $request->description ?? '',
                isActive: (bool) $request->is_active ?? true,
            )
        );

        return ApiAdapter::json($response, Response::HTTP_CREATED);
    }
}