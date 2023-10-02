<?php

namespace Core\Application\UseCases\CastMember;

use Core\Domain\Repository\CastMemberRepositoryInterface;
use Core\Domain\UseCases\CastMember\ListCastMemberUseCaseInterface;
use Core\Intermediate\Dtos\CastMember\ListCastMemberInputDto;
use Core\Intermediate\Dtos\CastMember\ListCastMemberOutputDto;

class ListCastMemberUseCase implements ListCastMemberUseCaseInterface
{
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
