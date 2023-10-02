<?php

namespace App\Http\Controllers\Api\Auth;

use App\Adapters\ApiAdapter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSignUpRequest;
use Core\Domain\UseCases\Auth\SignInUseCaseInterface;
use Core\Domain\UseCases\Auth\SignUpUseCaseInterface;
use Core\Intermediate\Dtos\Auth\SignInInputDto;
use Core\Intermediate\Dtos\Auth\SignUpInputDto;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SignUpController extends Controller
{
    public function __construct(
        protected SignUpUseCaseInterface $signUpUseCase,
        protected SignInUseCaseInterface $signInUseCase
    ) {
    }

    public function __invoke(StoreSignUpRequest $request): JsonResponse
    {
        $response = $this->signUpUseCase->execute(
            input: new SignUpInputDto(
                firstName: $request->first_name,
                lastName: $request->last_name,
                email: $request->email,
                password: $request->password
            )
        );

        $token = $this->getAuthenticationToken($request->email, $request->password);
        return ApiAdapter::json($response, Response::HTTP_CREATED, $token);
    }

    private function getAuthenticationToken(string $email, string $password): array
    {
        $token = $this->signInUseCase->execute(
            input: new SignInInputDto(
                email: $email,
                password:  $password
            )
        );

        return [
            'access_token' => $token->accessToken,
            'token_type' => $token->tokenType,
        ];
    }
}
