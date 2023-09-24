<?php

namespace Core\Domain\Builder\Genre;

use Core\Domain\Entity\Entity;
use Core\Domain\Entity\Genre;
use Core\Domain\Exception\NotificationException;
use Core\Domain\ValueObject\Uuid;

class UpdateGenreBuilder extends GenreBuilder implements GenreBuilderInterface
{
    protected ?Entity $entity = null;

    /**
     * @throws NotificationException
     */
    public function createEntity(object $input): GenreBuilderInterface
    {
        $this->entity = new Genre(
            name: $input->name,
            id: new Uuid($input->id),
            isActive: $input->isActive,
            categoriesId: $input->categoriesId,
            createdAt: new \DateTime($input->createdAt)
        );

        return $this;
    }

    public function setEntity(Entity $entity): GenreBuilderInterface
    {
        $this->entity = $entity;

        return $this;
    }

    public function addCategories(array $data): GenreBuilderInterface
    {
        foreach ($data as $categoryId) {
            $this->entity->addCategory($categoryId);
        }

        return $this;
    }
}
