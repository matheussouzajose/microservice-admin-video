<?php

namespace App\Http\Controllers\Api\Genre;

use App\Adapters\ApiAdapter;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateGenreRequest;
use Core\Domain\UseCases\Genre\UpdateGenreUseCaseInterface;
use Core\Intermediate\Dtos\Genre\UpdateGenreInputDto;
use Illuminate\Http\JsonResponse;

class UpdateGenreController extends Controller
{
    public function __construct(private readonly UpdateGenreUseCaseInterface $useCase)
    {
    }

    public function __invoke(UpdateGenreRequest $request, string $id): JsonResponse
    {
        $response = $this->useCase->execute(
            input: new UpdateGenreInputDto(
                id: $id,
                name: $request->name,
                categoriesId: $request->categories_ids
            )
        );

        return ApiAdapter::json($response);
    }
}
