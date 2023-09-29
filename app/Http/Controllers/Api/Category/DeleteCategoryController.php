<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use Core\Application\UseCases\Category\Delete\DeleteCategoryUseCaseInterface;
use Core\Application\UseCases\Category\Delete\DTO\DeleteCategoryInputDto;
use Illuminate\Http\Response;

class DeleteCategoryController extends Controller
{
    public function __construct(private readonly DeleteCategoryUseCaseInterface $useCase)
    {
    }

    public function __invoke(string $id): Response
    {
        $this->useCase->execute(new DeleteCategoryInputDto(
            id: $id
        ));

        return response()->noContent();
    }
}
