<?php

namespace App\Repositories\Eloquent;

use App\Models\CastMember as Model;
use App\Repositories\Presenters\PaginationPresenter;
use Core\Domain\Entity\CastMember;
use Core\Domain\Entity\Entity;
use Core\Domain\Enum\CastMemberType;
use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Exception\NotFoundException;
use Core\Domain\Repository\CastMemberRepositoryInterface;
use Core\Domain\Repository\PaginationInterface;
use Core\Domain\ValueObject\Uuid as ValueObjectUuid;

class CastMemberEloquentRepository implements CastMemberRepositoryInterface
{
    public function __construct(protected Model $model)
    {
    }

    /**
     * @param  CastMember  $entity
     * @return CastMember
     *
     * @throws EntityValidationException
     */
    public function insert(Entity $entity): Entity
    {
        $result = $this->model->create([
            'id' => $entity->id(),
            'name' => $entity->name,
            'type' => $entity->type->value,
            'created_at' => $entity->createdAt(),
        ]);

        return $this->convertObjectToEntity($result);
    }

    /**
     * @throws EntityValidationException
     */
    private function convertObjectToEntity(object $data): Entity
    {
        return new CastMember(
            name: $data->name,
            type: CastMemberType::from($data->type),
            id: new ValueObjectUuid($data->id),
            createdAt: $data->created_at
        );
    }

    /**
     * @throws NotFoundException|EntityValidationException
     */
    public function findById(string $entityId): Entity
    {
        if (! $result = $this->model->find($entityId)) {
            throw new NotFoundException("Cast Member {$entityId} Not Found");
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
     * @throws NotFoundException|EntityValidationException
     */
    public function update(Entity $entity): Entity
    {
        if (! $result = $this->model->find($entity->id())) {
            throw new NotFoundException("Cast Member {$entity->id()} Not Found");
        }

        $result->update([
            'name' => $entity->name,
            'type' => $entity->type->value,
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
            throw new NotFoundException("Cast Member {$entityId} Not Found");
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
