<?php

namespace Core\Application\UseCases\CastMember\Delete;

use Core\Application\UseCases\CastMember\Delete\DTO\DeleteCastMemberInputDto;
use Core\Application\UseCases\CastMember\Delete\DTO\DeleteCastMemberOutputDto;
use Core\Domain\Repository\CastMemberRepositoryInterface;

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
