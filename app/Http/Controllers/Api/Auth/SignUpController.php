<?php

namespace App\Http\Controllers\Api\Auth;

use App\Adapters\ApiAdapter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSignUpRequest;
use Core\Domain\UseCases\Auth\SignUpUseCaseInterface;
use Core\Intermediate\Dtos\Auth\SignUpInputDto;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SignUpController extends Controller
{
    public function __construct(protected SignUpUseCaseInterface $useCase)
    {
    }

    public function __invoke(StoreSignUpRequest $request): JsonResponse
    {
        $response = $this->useCase->execute(
            input: new SignUpInputDto(
                firstName: $request->first_name,
                lastName: $request->last_name,
                email: $request->email,
                password: $request->password
            )
        );

        return ApiAdapter::json($response, Response::HTTP_CREATED);
    }
}
