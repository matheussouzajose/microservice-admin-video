<?php

namespace Unit\Core\Domain\Entity;

use Core\Domain\Entity\User;
use Core\Domain\Exception\NotificationException;
use Core\Domain\ValueObject\Image;
use Tests\Fixtures\CreateEntity;
use Tests\Fixtures\UserFixtures;
use Tests\TestCase;

class UserUnitTest extends TestCase
{
    /**
     * @throws NotificationException
     */
    public function testAttributesSuccess()
    {
        $entity = CreateEntity::loadUser();

        $this->assertNotEmpty($entity->id());
        $this->assertNotEmpty($entity->createdAt());

        $this->assertEquals(UserFixtures::FIRST_NAME_MATHEUS, $entity->firstName);
        $this->assertEquals(UserFixtures::LAST_NAME_MATHEUS, $entity->lastName);
        $this->assertEquals(UserFixtures::EMAIL_MATHEUS, $entity->email);
        $this->assertEquals(UserFixtures::DEFAULT_PASSWORD, $entity->password);
        $this->assertEquals(UserFixtures::AVATAR_MATHEUS, $entity->userAvatar()->path());
    }

    /**
     * @throws NotificationException
     */
    public function testUpdateSuccess()
    {
        $entity = CreateEntity::loadUser();

        $firstNameUpdated = 'João';
        $lastNameUpdated = 'Paulo';

        $entity->update(
            firstName: $firstNameUpdated,
            lastName: $lastNameUpdated,
            email: $entity->email
        );

        $this->assertEquals($firstNameUpdated, $entity->firstName);
        $this->assertEquals($lastNameUpdated, $entity->lastName);
        $this->assertEquals(UserFixtures::EMAIL_MATHEUS, $entity->email);
        $this->assertNotEmpty($entity->updatedAt);
    }

    /**
     * @throws NotificationException
     */
    public function testUpdateAvatarUrlSuccess()
    {
        $entity = CreateEntity::loadUser();

        $image = 'path/clark-kent.jpg';
        $avatarUrl = new Image($image);
        $entity->setUserAvatar(
            path: $avatarUrl
        );

        $this->assertNotNull($entity->userAvatar());
        $this->assertInstanceOf(Image::class, $entity->userAvatar());
        $this->assertEquals($image, $entity->userAvatar()->path());
        $this->assertNotEmpty($entity->updatedAt);
    }

    /**
     * @throws NotificationException
     */
    public function testUpdatePassword()
    {
        $entity = CreateEntity::loadUser();

        $password = '987654321';
        $entity->updatePassword(
            password: $password
        );

        $this->assertEquals($password, $entity->password);
        $this->assertNotEmpty($entity->updatedAt);
    }

    public function testThrowsNotificationException()
    {
        $this->expectException(NotificationException::class);

        new User(
            firstName: '',
            lastName: '',
            email: 'invalid_mail',
            password: '123',
        );
    }
}
