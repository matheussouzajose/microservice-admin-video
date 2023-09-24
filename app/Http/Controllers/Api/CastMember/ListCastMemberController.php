<?php

namespace App\Http\Controllers\Api\CastMember;

use App\Adapters\ApiAdapter;
use App\Http\Controllers\Controller;
use Core\Data\UseCases\CastMember\List\DTO\ListCastMemberInputDto;
use Core\Data\UseCases\CastMember\List\ListCastMemberUseCaseInterface;
use Illuminate\Http\JsonResponse;

class ListCastMemberController extends Controller
{
    /**
     * @param ListCastMemberUseCaseInterface $useCase
     */
    public function __construct(private readonly ListCastMemberUseCaseInterface $useCase)
    {
    }

    /**
     * @param string $id
     * @return JsonResponse
     */
    public function __invoke(string $id): JsonResponse
    {
        $response = $this->useCase->execute(new ListCastMemberInputDto(
            id: $id
        ));

        return ApiAdapter::json($response);
    }
}
