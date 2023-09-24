<?php

namespace Core\Domain\Builder\Video;

use Core\Domain\Entity\Entity;
use Core\Domain\Entity\Video;
use Core\Domain\ValueObject\Uuid;

class UpdateVideoBuilder extends BuilderVideo
{
    public function createEntity(object $input): BuilderVideoInterface
    {
        $this->entity = new Video(
            title: $input->title,
            description: $input->description,
            yearLaunched: $input->yearLaunched,
            duration: $input->duration,
            opened: true,
            rating: $input->rating,
            id: new Uuid($input->id),
            createdAt: new \DateTime($input->createdAt),
        );

        $this->addIds($input);

        return $this;
    }

    public function setEntity(Entity $entity): BuilderVideoInterface
    {
        $this->entity = $entity;

        return $this;
    }
}
