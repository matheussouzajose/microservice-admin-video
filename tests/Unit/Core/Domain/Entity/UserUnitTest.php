<?php

namespace Unit\Core\Domain\Entity;

use Core\Domain\Entity\User;
use Core\Domain\Exception\NotificationException;
use Core\Domain\ValueObject\Image;
use Core\Domain\ValueObject\Uuid;
use Ramsey\Uuid\Uuid as RamseyUuid;
use Tests\TestCase;

class UserUnitTest extends TestCase
{
    /**
     * @throws NotificationException
     */
    private function createEntity(): User
    {
        $uuid = (string) RamseyUuid::uuid4();

        return new User(
            firstName: 'Clark',
            lastName: 'Kent',
            email: 'clark.kent@mail.com',
            password: '123456789',
            userAvatar: new Image('teste-path/image.png'),
            id: new Uuid($uuid)
        );
    }

    /**
     * @throws NotificationException
     */
    public function testAttributesSuccess()
    {
        $entity = $this->createEntity();

        $this->assertNotEmpty($entity->id());
        $this->assertNotEmpty($entity->createdAt());

        $this->assertEquals('Clark', $entity->firstName);
        $this->assertEquals('Kent', $entity->lastName);
        $this->assertEquals('clark.kent@mail.com', $entity->email);
        $this->assertEquals('123456789', $entity->password);
        $this->assertEquals('teste-path/image.png', $entity->userAvatar()->path());
    }

    /**
     * @throws NotificationException
     */
    public function testUpdateSuccess()
    {
        $entity = $this->createEntity();

        $entity->update(
            firstName: 'Clark updated',
            lastName: 'Kent updated',
            email: $entity->email
        );

        $this->assertEquals('Clark updated', $entity->firstName);
        $this->assertEquals('Kent updated', $entity->lastName);
        $this->assertEquals('clark.kent@mail.com', $entity->email);
        $this->assertNotEmpty($entity->updatedAt);
    }

    /**
     * @throws NotificationException
     */
    public function testUpdateAvatarUrlSuccess()
    {
        $entity = $this->createEntity();

        $avatarUrl = new Image('path/clark-kent.jpg');
        $entity->setUserAvatar(
            path: $avatarUrl
        );

        $this->assertNotNull($entity->userAvatar());
        $this->assertInstanceOf(Image::class, $entity->userAvatar());
        $this->assertEquals('path/clark-kent.jpg', $entity->userAvatar()->path());
        $this->assertNotEmpty($entity->updatedAt);
    }

    /**
     * @throws NotificationException
     */
    public function testUpdatePassword()
    {
        $entity = $this->createEntity();

        $entity->updatePassword(
            password: '987654321'
        );

        $this->assertEquals('987654321', $entity->password);
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
