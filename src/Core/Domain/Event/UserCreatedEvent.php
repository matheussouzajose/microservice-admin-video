<?php

namespace Core\Domain\Event;

use Core\Domain\Entity\User;

class UserCreatedEvent implements EventInterface
{
    public function __construct(
        protected User $user
    ) {
    }

    public function getEventName(): string
    {
        return 'user.created';
    }

    public function getPayload(): array
    {
        return [
            'id' => $this->user->id(),
            'first_name' => $this->user->firstName,
            'last_name' => $this->user->lastName,
            'email' => $this->user->email,
        ];
    }
}
