<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Core\Domain\UseCases\Auth\LogoutUseCaseInterface;
use Core\Intermediate\Dtos\Auth\LogoutInputDto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LogoutController extends Controller
{
    public function __construct(protected LogoutUseCaseInterface $useCase)
    {
    }

    public function __invoke(Request $request): Response
    {
        $id = $request->user()->id;
        $this->useCase->execute(
            input: new LogoutInputDto(
                id: $id
            )
        );

        return response()->noContent();
    }
}
