<?php

namespace App\Repositories\Eloquent;

use App\Models\Category as Model;
use App\Repositories\Presenters\PaginationPresenter;
use Core\Domain\Entity\Category;
use Core\Domain\Entity\Entity;
use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Exception\NotFoundException;
use Core\Domain\Exception\NotificationException;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\Repository\PaginationInterface;
use Core\Domain\ValueObject\Uuid;

class CategoryEloquentRepository implements CategoryRepositoryInterface
{
    public function __construct(protected Model $model)
    {
    }

    /**
     * @throws NotificationException|EntityValidationException
     */
    public function insert(Entity $entity): Entity
    {
        $result = $this->model->create([
            'id' => $entity->id(),
            'name' => $entity->name,
            'description' => $entity->description,
            'is_active' => $entity->isActive,
            'createdAt' => $entity->createdAt(),
        ]);

        return $this->convertObjectToEntity($result);
    }

    /**
     * @throws NotificationException
     */
    private function convertObjectToEntity(object $data): Entity
    {
        $entity = new Category(
            name: $data->name,
            id: new Uuid($data->id),
            description: $data->description,
            isActive: $data->is_active,
            createdAt: $data->created_at
        );

        $data->is_active ? $entity->activate() : $entity->deactivate();

        return $entity;
    }

    /**
     * @throws NotFoundException|EntityValidationException|NotificationException
     */
    public function findById(string $entityId): Entity
    {
        if (! $result = $this->model->find($entityId)) {
            throw new NotFoundException("Category {$entityId} not found");
        }

        return $this->convertObjectToEntity($result);
    }

    public function findAll(string $filter = '', string $order = 'DESC'): array
    {
        $result = $this->model->when($filter, function ($query) use ($filter) {
            $query->where('name', 'LIKE', "%{$filter}%");
        })
            ->orderBy('name', $order)
            ->get();

        return $result->toArray();
    }

    public function paginate(string $filter = '', string $order = 'DESC', int $page = 1, int $totalPage = 15): PaginationInterface
    {
        $result = $this->model->when($filter, function ($query) use ($filter) {
            $query->where('name', 'LIKE', "%{$filter}%");
        })
            ->orderBy('name', $order)
            ->paginate($totalPage, ['*'], 'page', $page);

        return new PaginationPresenter($result);
    }

    /**
     * @throws NotFoundException
     * @throws EntityValidationException|NotificationException
     */
    public function update(Entity $entity): Entity
    {
        if (! $result = $this->model->find($entity->id())) {
            throw new NotFoundException("Category {$entity->id()} not found");
        }

        $result->update([
            'name' => $entity->name,
            'description' => $entity->description,
            'is_active' => $entity->isActive,
        ]);

        $result->refresh();

        return $this->convertObjectToEntity($result);
    }

    /**
     * @throws NotFoundException
     */
    public function delete(string $entityId): bool
    {
        if (! $result = $this->model->find($entityId)) {
            throw new NotFoundException("Category {$entityId} not found");
        }

        return $result->delete();
    }

    public function getIdsByEntitiesIds(array $entityIds = []): array
    {
        return $this->model
            ->whereIn('id', $entityIds)
            ->pluck('id')
            ->toArray();
    }
}
