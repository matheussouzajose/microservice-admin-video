<?php

namespace Core\Data\UseCases\CastMember\Delete;

use Core\Data\UseCases\CastMember\Delete\DTO\DeleteCastMemberInputDto;
use Core\Data\UseCases\CastMember\Delete\DTO\DeleteCastMemberOutputDto;
use Core\Domain\Repository\CastMemberRepositoryInterface;

class
DeleteCastMemberUseCase implements DeleteCastMemberUseCaseInterface
{
    /**
     * @param CastMemberRepositoryInterface $repository
     */
    public function __construct(protected CastMemberRepositoryInterface $repository)
    {
    }

    /**
     * @param DeleteCastMemberInputDto $input
     * @return DeleteCastMemberOutputDto
     */
    public function execute(DeleteCastMemberInputDto $input): DeleteCastMemberOutputDto
    {
        $hasDeleted = $this->repository->delete($input->id);

        return new DeleteCastMemberOutputDto(
            success: $hasDeleted
        );
    }
}
