<?php

namespace Core\Domain\Repository;

use Core\Domain\Entity\User;

interface AuthRepositoryInterface
{
    public function insert(User $entity): User;

    public function checkByEmail(string $email): bool;

    public function findByEmail(string $email): User;

    public function createTokenByUserId(string $id): string;

    public function deleteTokensByUserId(string $id): bool;
}
