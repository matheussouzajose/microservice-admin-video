<?php

namespace App\Services\Notifications;

use App\Notifications\UserEmailVerification;
use Core\Domain\Services\UserNotificationInterface;
use Illuminate\Notifications\Notifiable;

class SendUserEmailVerification implements UserNotificationInterface
{
    use Notifiable;

    protected object $payload;

    public function __get(string $name)
    {
        return $this->{$name};
    }

    public function send(array $payload): void
    {
        $this->payload = (object) $payload;
        $this->notify(new UserEmailVerification);
    }

    public function getKey(): string
    {
        return $this->payload->id;
    }

    public function getEmailForVerification()
    {
        return $this->payload->email;
    }

    public function routeNotificationFor($driver, $notification = null): string
    {
        return $this->getEmailForVerification();
    }
}
