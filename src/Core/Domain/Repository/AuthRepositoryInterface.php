<?php

namespace Core\Domain\Repository;

use Core\Domain\Entity\User;

interface AuthRepositoryInterface
{
    public function signUp(User $entity): User;
}
