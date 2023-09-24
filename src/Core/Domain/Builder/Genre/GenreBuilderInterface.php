<?php

namespace Core\Domain\Builder\Genre;

use Core\Domain\Entity\Entity;

interface GenreBuilderInterface
{
    /**
     * @param object $input
     * @return GenreBuilderInterface
     */
    public function createEntity(object $input): GenreBuilderInterface;

    /**
     * @return Entity
     */
    public function getEntity(): Entity;
}
