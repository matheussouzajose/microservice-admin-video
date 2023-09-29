<?php

namespace Unit\Core\Domain\Entity;

use Core\Domain\ValueObject\Uuid;
use Tests\TestCase;
use Core\Domain\Entity\User;
use Ramsey\Uuid\Uuid as RamseyUuid;

class UserUnitTest extends TestCase
{
    public function testAttributesSuccess()
    {
        $uuid = (string) RamseyUuid::uuid4();

        $firstName = 'Clark';
        $lastName = 'Kent';
        $email = 'clark.kent@mail.com';
        $password = '123456789';
        $userAvatar = 'Clark';


        $entity = new User(
            firstName: $firstName,
            lastName: $lastName,
            email: $email,
            password: $password,
            userAvatar: $userAvatar,
            id: new Uuid($uuid)
        );

        $this->assertEquals($uuid, $entity->id());
        $this->assertEquals($uuid, $entity->firstName);
        $this->assertEquals($uuid, $entity->lastName);
        $this->assertEquals($uuid, $entity->email);
        $this->assertEquals($uuid, $entity->password);
        $this->assertEquals($uuid, $entity->userAvatar);
    }
}
