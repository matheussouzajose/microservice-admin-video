<?php

namespace App\Http\Controllers\Api\CastMember;

use App\Http\Controllers\Controller;
use Core\Data\UseCases\CastMember\Delete\DeleteCastMemberUseCaseInterface;
use Core\Data\UseCases\CastMember\Delete\DTO\DeleteCastMemberInputDto;
use Illuminate\Http\Response;

class DeleteCastMemberController extends Controller
{
    /**
     * @param DeleteCastMemberUseCaseInterface $useCase
     */
    public function __construct(private readonly DeleteCastMemberUseCaseInterface $useCase)
    {
    }

    /**
     * @param string $id
     * @return Response
     */
    public function __invoke(string $id): Response
    {
        $this->useCase->execute(new DeleteCastMemberInputDto(
            id: $id
        ));

        return response()->noContent();
    }
}
