<?php

namespace Core\Domain\Repository;

use Core\Domain\Entity\Entity;

interface EntityRepositoryInterface
{
    public function insert(Entity $entity): Entity;

    public function findById(string $entityId): Entity;

    public function findAll(string $filter = '', string $order = 'DESC'): array;

    public function paginate(string $filter = '', string $order = 'DESC', int $page = 1, int $totalPage = 15): PaginationInterface;

    public function update(Entity $entity): Entity;

    public function delete(string $entityId): bool;
}
