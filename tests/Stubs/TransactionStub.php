<?php

namespace Tests\Stubs;

use Core\Application\UseCases\Interfaces\TransactionInterface;

class TransactionStub implements TransactionInterface
{
    public function __construct()
    {
        event($this);
    }

    public function commit(): void
    {
        // TODO: Implement commit() method.
    }

    public function rollback(): void
    {
        // TODO: Implement rollback() method.
    }
}
