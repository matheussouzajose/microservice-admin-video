<?php

namespace Core\Domain\Services;

interface NotificationInterface
{
    public function send(array $payload);
}
