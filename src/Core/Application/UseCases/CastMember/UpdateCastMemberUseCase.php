<?php

namespace Core\Application\UseCases\CastMember;

use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Repository\CastMemberRepositoryInterface;
use Core\Domain\UseCases\CastMember\UpdateCastMemberUseCaseInterface;
use Core\Intermediate\Dtos\CastMember\UpdateCastMemberInputDto;
use Core\Intermediate\Dtos\CastMember\UpdateCastMemberOutputDto;

class UpdateCastMemberUseCase implements UpdateCastMemberUseCaseInterface
{
    public function __construct(protected CastMemberRepositoryInterface $repository)
    {
    }

    /**
     * @throws EntityValidationException
     */
    public function execute(UpdateCastMemberInputDto $input): UpdateCastMemberOutputDto
    {
        $entity = $this->repository->findById($input->id);
        $entity->update(name: $input->name);

        $this->repository->update($entity);

        return new UpdateCastMemberOutputDto(
            id: $entity->id(),
            name: $entity->name,
            type: $entity->type->value,
            created_at: $entity->createdAt(),
        );
    }
}
