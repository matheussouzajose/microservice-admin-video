<?php

namespace App\Services\AMQP;

interface AMQPInterface
{
    /**
     * @param string $queue
     * @param array $payload
     * @param string $exchange
     * @return void
     */
    public function producer(string $queue, array $payload, string $exchange): void;

    /**
     * @param array $payload
     * @param string $exchange
     * @return void
     */
    public function producerFannout(array $payload, string $exchange): void;

    /**
     * @param string $queue
     * @param string $exchange
     * @param \Closure $callback
     * @return void
     */
    public function consumer(string $queue, string $exchange, \Closure $callback): void;
}
