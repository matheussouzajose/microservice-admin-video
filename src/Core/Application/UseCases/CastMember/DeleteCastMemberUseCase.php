<?php

namespace Core\Application\UseCases\CastMember;

use Core\Domain\Repository\CastMemberRepositoryInterface;
use Core\Domain\UseCases\CastMember\DeleteCastMemberUseCaseInterface;
use Core\Intermediate\Dtos\CastMember\DeleteCastMemberInputDto;
use Core\Intermediate\Dtos\CastMember\DeleteCastMemberOutputDto;

class DeleteCastMemberUseCase implements DeleteCastMemberUseCaseInterface
{
    public function __construct(protected CastMemberRepositoryInterface $repository)
    {
    }

    public function execute(DeleteCastMemberInputDto $input): DeleteCastMemberOutputDto
    {
        $hasDeleted = $this->repository->delete($input->id);

        return new DeleteCastMemberOutputDto(
            success: $hasDeleted
        );
    }
}
