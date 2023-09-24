<?php

namespace Core\Domain\Repository;

interface GenreRepositoryInterface extends EntityRepositoryInterface
{
    public function getIdsByEntitiesIds(array $entityIds = []): array;
}
