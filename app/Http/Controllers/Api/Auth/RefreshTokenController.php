<?php

namespace App\Http\Controllers\Api\Auth;

use App\Adapters\ApiAdapter;
use App\Http\Controllers\Controller;
use Core\Domain\UseCases\Auth\RefreshTokenUseCaseInterface;
use Core\Intermediate\Dtos\Auth\RefreshTokenInputDto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RefreshTokenController extends Controller
{
    public function __construct(protected RefreshTokenUseCaseInterface $useCase)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $id = $request->user()->id;
        $response = $this->useCase->execute(
            input: new RefreshTokenInputDto(
                id: $id
            )
        );

        return ApiAdapter::json($response, Response::HTTP_OK);
    }
}
