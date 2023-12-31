<?php

namespace App\Http\Controllers\Api\CastMember;

use App\Adapters\ApiAdapter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCastMemberRequest;
use Core\Domain\UseCases\CastMember\CreateCastMemberUseCaseInterface;
use Core\Intermediate\Dtos\CastMember\CreateCastMemberInputDto;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreateCastMemberController extends Controller
{
    public function __construct(private readonly CreateCastMemberUseCaseInterface $useCase)
    {
    }

    public function __invoke(StoreCastMemberRequest $request): JsonResponse
    {
        $response = $this->useCase->execute(
            input: new CreateCastMemberInputDto(
                name: $request->name,
                type: (int) $request->type,
            )
        );

        return ApiAdapter::json($response, Response::HTTP_CREATED);
        //        return (new CastMemberResource($response))
        //            ->response()
        //            ->setStatusCode();
    }
}
