<?php

namespace App\Http\Controllers\Api\Category;

use App\Adapters\ApiAdapter;
use App\Http\Controllers\Controller;
use Core\Domain\UseCases\Category\ListCategoryUseCaseInterface;
use Core\Intermediate\Dtos\Category\ListCategoryInputDto;
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
