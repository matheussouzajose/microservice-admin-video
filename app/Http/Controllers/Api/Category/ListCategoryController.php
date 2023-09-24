<?php

namespace App\Http\Controllers\Api\Category;

use App\Adapters\ApiAdapter;
use App\Http\Controllers\Controller;
use Core\Data\UseCases\Category\List\DTO\ListCategoryInputDto;
use Core\Data\UseCases\Category\List\ListCategoryUseCaseInterface;
use Illuminate\Http\JsonResponse;

class ListCategoryController extends Controller
{
    /**
     * @param ListCategoryUseCaseInterface $useCase
     */
    public function __construct(private readonly ListCategoryUseCaseInterface $useCase)
    {
    }

    /**
     * @param string $id
     * @return JsonResponse
     */
    public function __invoke(string $id): JsonResponse
    {
        $category = $this->useCase->execute(
            input: new ListCategoryInputDto(
                id: $id
            )
        );

        return ApiAdapter::json($category);
    }
}
