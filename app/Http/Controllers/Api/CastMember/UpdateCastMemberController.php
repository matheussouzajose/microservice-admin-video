<?php

namespace App\Http\Controllers\Api\CastMember;

use App\Adapters\ApiAdapter;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCastMemberRequest;
use Core\Domain\UseCases\CastMember\UpdateCastMemberUseCaseInterface;
use Core\Intermediate\Dtos\CastMember\UpdateCastMemberInputDto;
use Illuminate\Http\JsonResponse;

class UpdateCastMemberController extends Controller
{
    public function __construct(private readonly UpdateCastMemberUseCaseInterface $useCase)
    {
    }

    public function __invoke(UpdateCastMemberRequest $request, $id): JsonResponse
    {
        $response = $this->useCase->execute(
            input: new UpdateCastMemberInputDto(
                id: $id,
                name: $request->name,
            )
        );

        return ApiAdapter::json($response);
    }
}
