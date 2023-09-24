<?php

namespace Core\Domain\Repository;

use Core\Domain\Entity\Entity;

interface EntityRepositoryInterface
{
    /**
     * @param Entity $entity
     * @return Entity
     */
    public function insert(Entity $entity): Entity;

    /**
     * @param string $entityId
     * @return Entity
     */
    public function findById(string $entityId): Entity;

    /**
     * @param string $filter
     * @param string $order
     * @return array
     */
    public function findAll(string $filter = '', string $order = 'DESC'): array;

    /**
     * @param string $filter
     * @param string $order
     * @param int $page
     * @param int $totalPage
     * @return PaginationInterface
     */
    public function paginate(string $filter = '', string $order = 'DESC', int $page = 1, int $totalPage = 15): PaginationInterface;

    /**
     * @param Entity $entity
     * @return Entity
     */
    public function update(Entity $entity): Entity;

    /**
     * @param string $entityId
     * @return bool
     */
    public function delete(string $entityId): bool;
}
