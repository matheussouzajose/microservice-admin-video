<?php

namespace Core\Domain\Builder\Genre;

use Core\Domain\Entity\Entity;

interface GenreBuilderInterface
{
    public function createEntity(object $input): GenreBuilderInterface;

    public function getEntity(): Entity;
}
