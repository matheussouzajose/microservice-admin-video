<?php

namespace Core\Domain\Repository;

use Core\Domain\Entity\Entity;

interface VideoRepositoryInterface
{
    public function updateMedia(Entity $entity): Entity;
}
