<?php

namespace App\Http\Controllers\Api\Genre;

use App\Adapters\ApiAdapter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGenreRequest;
use Core\Application\UseCases\Genre\Create\CreateGenreUseCaseInterface;
use Core\Application\UseCases\Genre\Create\DTO\CreateGenreInputDto;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreateGenreController extends Controller
{
    public function __construct(private readonly CreateGenreUseCaseInterface $useCase)
    {
    }

    public function __invoke(StoreGenreRequest $request): JsonResponse
    {
        $response = $this->useCase->execute(
            input: new CreateGenreInputDto(
                name: $request->name,
                categoriesId: $request->categories_ids,
                isActive: (bool) $request->is_active
            )
        );

        return ApiAdapter::json($response, Response::HTTP_CREATED);
    }
}
