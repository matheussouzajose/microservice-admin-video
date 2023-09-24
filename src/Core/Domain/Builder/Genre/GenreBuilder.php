<?php

namespace Core\Domain\Builder\Genre;

use Core\Domain\Entity\Entity;
use Core\Domain\Entity\Genre;
use Core\Domain\Exception\NotificationException;

class GenreBuilder implements GenreBuilderInterface
{
    /** @var Entity|null */
    protected ?Entity $entity = null;

    public function __construct()
    {
        $this->reset();
    }

    /**
     * @return void
     */
    private function reset(): void
    {
        $this->entity = null;
    }

    /**
     * @param object $input
     * @return GenreBuilderInterface
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

    /**
     * @return Entity
     */
    public function getEntity(): Entity
    {
        return $this->entity;
    }
}
