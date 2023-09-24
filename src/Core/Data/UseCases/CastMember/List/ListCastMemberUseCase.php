<?php

namespace Core\Data\UseCases\CastMember\List;

use Core\Data\UseCases\CastMember\DTO\CastMemberInputDto;
use Core\Data\UseCases\CastMember\DTO\CastMemberOutputDto;
use Core\Data\UseCases\CastMember\List\DTO\ListCastMemberInputDto;
use Core\Data\UseCases\CastMember\List\DTO\ListCastMemberOutputDto;
use Core\Domain\Repository\CastMemberRepositoryInterface;

class ListCastMemberUseCase implements ListCastMemberUseCaseInterface
{
    /**
     * @param CastMemberRepositoryInterface $repository
     */
    public function __construct(protected CastMemberRepositoryInterface $repository)
    {
    }

    public function execute(ListCastMemberInputDto $input): ListCastMemberOutputDto
    {
        $castMember = $this->repository->findById($input->id);

        return new ListCastMemberOutputDto(
            id: $castMember->id(),
            name: $castMember->name,
            type: $castMember->type->value,
            created_at: $castMember->createdAt(),
        );
    }
}
