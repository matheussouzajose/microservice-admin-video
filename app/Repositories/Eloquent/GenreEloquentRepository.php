<?php

namespace App\Repositories\Eloquent;

use App\Models\Genre as Model;
use App\Repositories\Presenters\PaginationPresenter;
use Core\Domain\Entity\Entity;
use Core\Domain\Entity\Genre;
use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Exception\NotFoundException;
use Core\Domain\Exception\NotificationException;
use Core\Domain\Repository\GenreRepositoryInterface;
use Core\Domain\Repository\PaginationInterface;
use Core\Domain\ValueObject\Uuid;

class GenreEloquentRepository implements GenreRepositoryInterface
{
    /**
     * @param Model $model
     */
    public function __construct(protected Model $model)
    {
    }

    /**
     * @param Entity $entity
     * @return Entity
     * @throws EntityValidationException|NotificationException
     */
    public function insert(Entity $entity): Entity
    {
        $result = $this->model->create([
            'id' => $entity->id(),
            'name' => $entity->name,
            'is_active' => $entity->isActive,
            'created_at' => $entity->createdAt(),
        ]);

        if (count($entity->categoriesId) > 0) {
            $result->categories()->sync($entity->categoriesId);
        }

        return $this->convertObjectToEntity($result);
    }

    /**
     * @param object $data
     * @return Entity
     * @throws NotificationException
     */
    private function convertObjectToEntity(object $data): Entity
    {
        $entity = new Genre(
            name: $data->name,
            id: new Uuid($data->id),
            createdAt: new \DateTime($data->created_at),
        );

        $data->is_active ? $entity->activate() : $entity->deactivate();

        return $entity;
    }

    /**
     * @param string $entityId
     * @return Entity
     * @throws NotFoundException|NotificationException
     */
    public function findById(string $entityId): Entity
    {
        if (!$result = $this->model->find($entityId)) {
            throw new NotFoundException("Genre {$entityId} not found");
        }

        return $this->convertObjectToEntity($result);
    }

    /**
     * @param string $filter
     * @param string $order
     * @return array
     */
    public function findAll(string $filter = '', string $order = 'DESC'): array
    {
        $result = $this->model->when($filter, function ($query) use ($filter) {
            $query->where('name', 'LIKE', "%{$filter}%");
        })
            ->orderBy('name', $order)
            ->get();

        return $result->toArray();
    }

    /**
     * @param string $filter
     * @param string $order
     * @param int $page
     * @param int $totalPage
     * @return PaginationInterface
     */
    public function paginate(string $filter = '', string $order = 'DESC', int $page = 1, int $totalPage = 15): PaginationInterface
    {
        $result = $this->model->when($filter, function ($query) use ($filter) {
            $query->where('name', 'LIKE', "%{$filter}%");
        })
            ->with('categories')
            ->orderBy('name', $order)
            ->paginate($totalPage, ['*'], 'page', $page);

        return new PaginationPresenter($result);
    }

    /**
     * @param Entity $entity
     * @return Entity
     * @throws NotFoundException|EntityValidationException|NotificationException
     */
    public function update(Entity $entity): Entity
    {
        if (!$result = $this->model->find($entity->id)) {
            throw new NotFoundException("Genre {$entity->id} not found");
        }

        $result->update([
            'name' => $entity->name,
        ]);

        if (count($entity->categoriesId) > 0) {
            $result->categories()->sync($entity->categoriesId);
        }

        $result->refresh();

        return $this->convertObjectToEntity($result);
    }

    /**
     * @param string $entityId
     * @return bool
     * @throws NotFoundException
     */
    public function delete(string $entityId): bool
    {
        if (!$result = $this->model->find($entityId)) {
            throw new NotFoundException("Genre {$entityId} not found");
        }

        return $result->delete();
    }

    /**
     * @param array $entityIds
     * @return array
     */
    public function getIdsByEntitiesIds(array $entityIds = []): array
    {
        return $this->model
            ->whereIn('id', $entityIds)
            ->pluck('id')
            ->toArray();
    }
}
