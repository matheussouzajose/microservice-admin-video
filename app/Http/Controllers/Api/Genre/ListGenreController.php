<?php

namespace App\Http\Controllers\Api\Genre;

use App\Adapters\ApiAdapter;
use App\Http\Controllers\Controller;
use Core\Domain\UseCases\Genre\ListGenreUseCaseInterface;
use Core\Intermediate\Dtos\Genre\ListGenreInputDto;
use Illuminate\Http\JsonResponse;

class ListGenreController extends Controller
{
    public function __construct(private readonly ListGenreUseCaseInterface $useCase)
    {
    }

    public function __invoke(string $id): JsonResponse
    {
        $response = $this->useCase->execute(
            input: new ListGenreInputDto(
                id: $id
            )
        );

        return ApiAdapter::json($response);
    }
}
