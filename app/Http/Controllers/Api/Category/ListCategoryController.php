<?php

namespace App\Http\Controllers\Api\Category;

use App\Adapters\ApiAdapter;
use App\Http\Controllers\Controller;
use Core\Application\UseCases\Category\List\DTO\ListCategoryInputDto;
use Core\Application\UseCases\Category\List\ListCategoryUseCaseInterface;
use Illuminate\Http\JsonResponse;

class ListCategoryController extends Controller
{
    public function __construct(private readonly ListCategoryUseCaseInterface $useCase)
    {
    }

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
