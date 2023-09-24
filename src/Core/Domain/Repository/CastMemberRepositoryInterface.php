<?php

namespace Core\Domain\Repository;

interface CastMemberRepositoryInterface extends EntityRepositoryInterface
{
    public function getIdsByEntitiesIds(array $entityIds = []): array;
}
