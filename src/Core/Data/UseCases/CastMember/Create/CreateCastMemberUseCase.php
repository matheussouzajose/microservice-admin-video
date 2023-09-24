<?php

namespace Core\Data\UseCases\CastMember\Create;

use Core\Data\UseCases\CastMember\Create\DTO\CreateCastMemberInputDto;
use Core\Data\UseCases\CastMember\Create\DTO\CreateCastMemberOutputDto;
use Core\Domain\Entity\CastMember;
use Core\Domain\Enum\CastMemberType;
use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Repository\CastMemberRepositoryInterface;

class CreateCastMemberUseCase implements CreateCastMemberUseCaseInterface
{

    /**
     * @param CastMemberRepositoryInterface $repository
     */
    public function __construct(protected CastMemberRepositoryInterface $repository)
    {
    }

    /**
     * @param CreateCastMemberInputDto $input
     * @return CreateCastMemberOutputDto
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
