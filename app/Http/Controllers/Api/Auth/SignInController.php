<?php

namespace App\Http\Controllers\Api\Auth;

use App\Adapters\ApiAdapter;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignInRequest;
use Core\Domain\UseCases\Auth\SignInUseCaseInterface;
use Core\Intermediate\Dtos\Auth\SignInInputDto;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SignInController extends Controller
{
    public function __construct(protected SignInUseCaseInterface $useCase)
    {
    }

    public function __invoke(SignInRequest $request): JsonResponse
    {
        $response = $this->useCase->execute(
            input: new SignInInputDto(
                email: $request->email,
                password: $request->password
            )
        );

        return ApiAdapter::json($response, Response::HTTP_OK);
    }
}
