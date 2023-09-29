<?php

namespace App\Http\Controllers\Api\CastMember;

use App\Http\Controllers\Controller;
use Core\Application\UseCases\CastMember\Delete\DeleteCastMemberUseCaseInterface;
use Core\Application\UseCases\CastMember\Delete\DTO\DeleteCastMemberInputDto;
use Illuminate\Http\Response;

class DeleteCastMemberController extends Controller
{
    public function __construct(private readonly DeleteCastMemberUseCaseInterface $useCase)
    {
    }

    public function __invoke(string $id): Response
    {
        $this->useCase->execute(new DeleteCastMemberInputDto(
            id: $id
        ));

        return response()->noContent();
    }
}
