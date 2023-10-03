<?php

namespace App\Repositories\Eloquent;

use App\Models\User as Model;
use Core\Domain\Entity\User;
use Core\Domain\Exception\NotFoundException;
use Core\Domain\Exception\NotificationException;
use Core\Domain\Repository\AuthRepositoryInterface;
use Core\Domain\ValueObject\Image;
use Core\Domain\ValueObject\Uuid;

class AuthEloquentRepository implements AuthRepositoryInterface
{
    public function __construct(protected Model $model)
    {
    }

    /**
     * @throws NotificationException
     */
    public function insert(User $entity): User
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
            password: $data->password,
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

    public function checkByEmail(string $email): bool
    {
        return $this->model->where('email', $email)->exists();
    }

    /**
     * @throws NotFoundException
     * @throws NotificationException
     */
    public function findByEmail(string $email): User
    {
        if (! $result = $this->model->where('email', $email)->first()) {
            throw new NotFoundException("User {$email} Not Found");
        }

        return $this->convertObjectToEntity($result);
    }

    /**
     * @throws NotFoundException
     */
    public function createTokenByUserId(string $id): string
    {
        if (! $result = $this->model->find($id)) {
            throw new NotFoundException("User {$id} Not Found");
        }
        return $result->createToken('authtoken')->plainTextToken;
    }

    /**
     * @throws NotFoundException
     */
    public function deleteTokensByUserId(string $id): bool
    {
        if (! $result = $this->model->find($id)) {
            throw new NotFoundException("User {$id} Not Found");
        }

        return $result->tokens()->delete() > 0;
    }
}
