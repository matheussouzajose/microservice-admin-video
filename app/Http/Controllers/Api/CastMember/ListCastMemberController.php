<?php

namespace App\Http\Controllers\Api\CastMember;

use App\Adapters\ApiAdapter;
use App\Http\Controllers\Controller;
use Core\Domain\UseCases\CastMember\ListCastMemberUseCaseInterface;
use Core\Intermediate\Dtos\CastMember\ListCastMemberInputDto;
use Illuminate\Http\JsonResponse;

class ListCastMemberController extends Controller
{
    public function __construct(private readonly ListCastMemberUseCaseInterface $useCase)
    {
    }

    public function __invoke(string $id): JsonResponse
    {
        $response = $this->useCase->execute(new ListCastMemberInputDto(
            id: $id
        ));

        return ApiAdapter::json($response);
    }
}
