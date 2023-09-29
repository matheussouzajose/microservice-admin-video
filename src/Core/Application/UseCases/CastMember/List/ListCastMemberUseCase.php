<?php

namespace Core\Application\UseCases\CastMember\List;

use Core\Application\UseCases\CastMember\List\DTO\ListCastMemberInputDto;
use Core\Application\UseCases\CastMember\List\DTO\ListCastMemberOutputDto;
use Core\Domain\Repository\CastMemberRepositoryInterface;

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
