<?php

namespace Core\Domain\Builder\Genre;

use Core\Domain\Entity\Entity;
use Core\Domain\Entity\Genre;
use Core\Domain\Exception\NotificationException;

class GenreBuilder implements GenreBuilderInterface
{
    protected ?Entity $entity = null;

    public function __construct()
    {
        $this->reset();
    }

    private function reset(): void
    {
        $this->entity = null;
    }

    /**
     * @throws NotificationException
     */
    public function createEntity(object $input): GenreBuilderInterface
    {
        $this->entity = new Genre(
            name: $input->name,
            isActive: $input->isActive,
            categoriesId: $input->categoriesId
        );

        return $this;
    }

    public function getEntity(): Entity
    {
        return $this->entity;
    }
}
