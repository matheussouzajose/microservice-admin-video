<?php

namespace Tests\Fixtures;

use Core\Domain\Entity\User;
use Core\Domain\Exception\NotificationException;
use Core\Domain\ValueObject\Image;
use Core\Domain\ValueObject\Uuid;

class CreateEntity
{
    /**
     * @throws NotificationException
     */
    public static function loadUser(): User
    {
        return new User(
            firstName: UserFixtures::FIRST_NAME_MATHEUS,
            lastName: UserFixtures::LAST_NAME_MATHEUS,
            email: UserFixtures::EMAIL_MATHEUS,
            password: UserFixtures::DEFAULT_PASSWORD,
            userAvatar: new Image(UserFixtures::AVATAR_MATHEUS),
            id: new Uuid(UserFixtures::UUID_MATHEUS)
        );
    }
}
