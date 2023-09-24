<?php

namespace Core\Domain\Validation;

use Core\Domain\Entity\Entity;

interface ValidatorInterface
{
    /**
     * @param Entity $entity
     * @return void
     */
    public function validate(Entity $entity): void;
}
