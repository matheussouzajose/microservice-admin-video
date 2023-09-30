<?php

namespace Unit\Core\Domain\Event;

use Core\Domain\Entity\User;
use Core\Domain\Event\UserCreatedEvent;
use Core\Domain\ValueObject\Uuid;
use Ramsey\Uuid\Uuid as RamseyUuid;
use Tests\TestCase;

class UserCreatedEventUnitTest extends TestCase
{
    public function testUserCreatedEvent()
    {
        $uuid = new Uuid((string) RamseyUuid::uuid4());
        $entity = new User(
            firstName: 'Matheus',
            lastName: 'Jose',
            email: 'matheus.jose@mail.com',
            id: $uuid
        );

        $event = new UserCreatedEvent($entity);

        $eventName = $event->getEventName();
        $this->assertEquals('user.created', $eventName);

        $payload = $event->getPayload();
        $this->assertEquals([
            'id' => $uuid,
            'first_name' => 'Matheus',
            'last_name' => 'Jose',
            'email' => 'matheus.jose@mail.com',
        ], $payload);
    }
}
