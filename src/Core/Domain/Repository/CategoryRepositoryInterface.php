<?php

namespace Core\Domain\Repository;

interface CategoryRepositoryInterface extends EntityRepositoryInterface
{
    public function getIdsByEntitiesIds(array $entityIds = []): array;
}
