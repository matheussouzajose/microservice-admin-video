<?php

namespace App\Repositories\Eloquent;

use App\Models\User as Model;
use Core\Domain\Entity\User;
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
    public function signUp(User $entity): User
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
}
