<?php

namespace App\Http\Controllers\Api\Genre;

use App\Adapters\ApiAdapter;
use App\Http\Controllers\Controller;
use Core\Data\UseCases\Genre\List\DTO\ListGenreInputDto;
use Core\Data\UseCases\Genre\List\ListGenreUseCaseInterface;
use Illuminate\Http\JsonResponse;

class ListGenreController extends Controller
{
    /**
     * @param ListGenreUseCaseInterface $useCase
     */
    public function __construct(private readonly ListGenreUseCaseInterface $useCase)
    {
    }

    /**
     * @param string $id
     * @return JsonResponse
     */
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
