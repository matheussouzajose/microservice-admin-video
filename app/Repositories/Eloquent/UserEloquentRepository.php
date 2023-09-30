<?php

namespace App\Repositories\Eloquent;

use App\Models\User as Model;
use App\Repositories\Presenters\PaginationPresenter;
use Core\Domain\Entity\Entity;
use Core\Domain\Entity\User;
use Core\Domain\Exception\NotFoundException;
use Core\Domain\Exception\NotificationException;
use Core\Domain\Repository\PaginationInterface;
use Core\Domain\Repository\UserRepositoryInterface;
use Core\Domain\ValueObject\Image;
use Core\Domain\ValueObject\Uuid;
use Illuminate\Support\Facades\Cache;

class UserEloquentRepository implements UserRepositoryInterface
{
    public function __construct(protected Model $model)
    {
    }

    /**
     * @throws NotificationException
     */
    public function insert(Entity $entity): Entity
    {
        $result = $this->model->create([
            'id' => $entity->id(),
            'first_name' => $entity->firstName,
            'last_name' => $entity->lastName,
            'email' => $entity->email,
            'password' => $entity->password,
            'created_at' => $entity->createdAt(),
        ]);

        return $this->convertObjectToEntity($result);
    }

    /**
     * @throws NotificationException
     */
    protected function convertObjectToEntity(object $data): User
    {
        $entity = new User(
            firstName: $data->first_name,
            lastName: $data->last_name,
            email: $data->email,
            id: new Uuid($data->id),
            emailVerifiedAt: $data->email_verified_at,
            createdAt: $data->created_at,
            updatedAt: $data->updated_at,
        );

        if ($userAvatar = $data->user_avatar) {
            $entity->setUserAvatar(
                path: new Image($userAvatar)
            );
        }

        return $entity;
    }

    /**
     * @throws NotFoundException
     * @throws NotificationException
     */
    public function findById(string $entityId): Entity
    {
        if (! $result = $this->model->find($entityId)) {
            throw new NotFoundException("User {$entityId} not found");
        }

        return $this->convertObjectToEntity($result);
    }

    public function findAll(string $filter = '', string $order = 'DESC'): array
    {
        $result = $this->model->when($filter, function ($query) use ($filter) {
            $query->where('first_name', 'LIKE', "%{$filter}%")
                ->orWhere('last_name', 'LIKE', "%{$filter}%")
                ->orWhere('email', 'LIKE', "%{$filter}%");
        })
            ->orderBy('first_name', $order)
            ->get();

        return $result->toArray();
    }

    public function paginate(string $filter = '', string $order = 'DESC', int $page = 1, int $totalPage = 15): PaginationInterface
    {
        $result = $this->model->when($filter, function ($query) use ($filter) {
            $query->where('first_name', 'LIKE', "%{$filter}%")
                ->orWhere('last_name', 'LIKE', "%{$filter}%")
                ->orWhere('email', 'LIKE', "%{$filter}%");
        })
            ->orderBy('first_name', $order)
            ->paginate($totalPage, ['*'], 'page', $page);

        return new PaginationPresenter($result);
    }

    /**
     * @throws NotFoundException
     * @throws NotificationException
     */
    public function update(Entity $entity): Entity
    {
        if (! $result = $this->model->find($entity->id())) {
            throw new NotFoundException("Video {$entity->id} not found");
        }

        $result->update([
            'title' => $entity->title,
            'description' => $entity->description,
            'year_launched' => $entity->yearLaunched,
            'rating' => $entity->rating->value,
            'duration' => $entity->duration,
            'opened' => $entity->opened,
        ]);

        $result->refresh();

        $this->syncRelationships($result, $entity);

        return $this->convertObjectToEntity($result);
    }

    /**
     * @throws NotFoundException
     */
    public function delete(string $entityId): bool
    {
        if (! $result = $this->model->find($entityId)) {
            throw new NotFoundException("Video {$entityId} not found");
        }

        return $result->delete();
    }

    /**
     * @throws NotFoundException
     * @throws NotificationException
     */
    public function updateMedia(Entity $entity): Entity
    {
        if (! $result = $this->model->find($entity->id())) {
            throw new NotFoundException("Video {$entity->id} not found");
        }

        $this->updateMediaVideo($entity, $result);
        $this->updateMediaTrailer($entity, $result);

        $this->updateImageBanner($entity, $result);
        $this->updateImageThumb($entity, $result);
        $this->updateImageThumbHalf($entity, $result);

        return $this->convertObjectToEntity($result);
    }
}
