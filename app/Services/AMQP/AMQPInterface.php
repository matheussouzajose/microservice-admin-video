<?php

namespace App\Services\AMQP;

interface AMQPInterface
{
    public function producer(string $queue, array $payload, string $exchange): void;

    public function producerFannout(array $payload, string $exchange): void;

    public function consumer(string $queue, string $exchange, \Closure $callback): void;
}
