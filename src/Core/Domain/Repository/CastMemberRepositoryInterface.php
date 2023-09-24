<?php

namespace Core\Domain\Repository;

interface CastMemberRepositoryInterface extends EntityRepositoryInterface
{
    /**
     * @param array $entityIds
     * @return array
     */
    public function getIdsByEntitiesIds(array $entityIds = []): array;
}
