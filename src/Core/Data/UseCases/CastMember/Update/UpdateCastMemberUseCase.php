<?php

namespace Core\Data\UseCases\CastMember\Update;

use Core\Data\UseCases\CastMember\Update\DTO\UpdateCastMemberInputDto;
use Core\Data\UseCases\CastMember\Update\DTO\UpdateCastMemberOutputDto;
use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Repository\CastMemberRepositoryInterface;

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
