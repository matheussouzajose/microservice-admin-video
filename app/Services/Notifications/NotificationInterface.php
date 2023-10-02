<?php

namespace App\Services\Notifications;

interface NotificationInterface
{
    public function send(array $payload);
}
