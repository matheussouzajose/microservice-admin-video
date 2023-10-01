<?php

namespace Unit\Core\Domain\Event;

use Core\Domain\Event\UserCreatedEvent;
use Core\Domain\Exception\NotificationException;
use Tests\Fixtures\CreateEntity;
use Tests\Fixtures\UserFixtures;
use Tests\TestCase;

class UserCreatedEventUnitTest extends TestCase
{
    /**
     * @throws NotificationException
     */
    public function testUserCreatedEvent()
    {
        $entity = CreateEntity::loadUser();
        $event = new UserCreatedEvent($entity);

        $eventName = $event->getEventName();
        $payload = $event->getPayload();

        $this->assertEquals('user.created', $eventName);
        $this->assertNotEmpty($payload['id']);
        $this->assertEquals(UserFixtures::FIRST_NAME_MATHEUS, $payload['first_name']);
        $this->assertEquals(UserFixtures::LAST_NAME_MATHEUS, $payload['last_name']);
        $this->assertEquals(UserFixtures::EMAIL_MATHEUS, $payload['email']);
    }
}
