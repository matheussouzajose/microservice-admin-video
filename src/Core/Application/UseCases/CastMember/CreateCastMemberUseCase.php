<?php

namespace Core\Application\UseCases\CastMember;

use Core\Domain\Entity\CastMember;
use Core\Domain\Enum\CastMemberType;
use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Repository\CastMemberRepositoryInterface;
use Core\Domain\UseCases\CastMember\CreateCastMemberUseCaseInterface;
use Core\Intermediate\Dtos\CastMember\CreateCastMemberInputDto;
use Core\Intermediate\Dtos\CastMember\CreateCastMemberOutputDto;

class CreateCastMemberUseCase implements CreateCastMemberUseCaseInterface
{
    public function __construct(protected CastMemberRepositoryInterface $repository)
    {
    }

    /**
     * @throws EntityValidationException
     */
    public function execute(CreateCastMemberInputDto $input): CreateCastMemberOutputDto
    {
        $entity = new CastMember(
            name: $input->name,
            type: $input->type == 1 ? CastMemberType::DIRECTOR : CastMemberType::ACTOR
        );

        $this->repository->insert($entity);

        return new CreateCastMemberOutputDto(
            id: $entity->id(),
            name: $entity->name,
            type: $input->type,
            created_at: $entity->createdAt(),
        );
    }
}
