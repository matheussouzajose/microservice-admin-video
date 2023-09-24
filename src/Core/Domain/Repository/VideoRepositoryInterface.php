<?php

namespace Core\Domain\Repository;

use Core\Domain\Entity\Entity;

interface VideoRepositoryInterface
{
    /**
     * @param Entity $entity
     * @return Entity
     */
    public function updateMedia(Entity $entity): Entity;
}
