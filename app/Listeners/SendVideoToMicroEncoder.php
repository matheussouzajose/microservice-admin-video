<?php

namespace App\Listeners;

use App\Services\AMQP\AMQPInterface;

class SendVideoToMicroEncoder
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(private AMQPInterface $amqp)
    {

    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $this->amqp->producerFannout(
            payload: $event->getPayload(),
            exchange: config('microservices.micro_encoder_go.exchange')
        );

        // Send for the same queue that is consumer, only test.
        //        $this->amqp->producer(
        //            queue: config('microservices.queue_name'),
        //            payload: $event->getPayload(),
        //            exchange: config('microservices.micro_encoder_go.exchange_producer')
        //        );
    }
}
