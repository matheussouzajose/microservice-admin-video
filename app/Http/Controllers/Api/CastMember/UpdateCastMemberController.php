<?php

namespace App\Http\Controllers\Api\CastMember;

use App\Adapters\ApiAdapter;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCastMemberRequest;
use Core\Data\UseCases\CastMember\Update\DTO\UpdateCastMemberInputDto;
use Core\Data\UseCases\CastMember\Update\UpdateCastMemberUseCaseInterface;
use Illuminate\Http\JsonResponse;

class UpdateCastMemberController extends Controller
{
    /**
     * @param UpdateCastMemberUseCaseInterface $useCase
     */
    public function __construct(private readonly UpdateCastMemberUseCaseInterface $useCase)
    {
    }

    /**
     * @param UpdateCastMemberRequest $request
     * @param $id
     * @return JsonResponse
     */
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
