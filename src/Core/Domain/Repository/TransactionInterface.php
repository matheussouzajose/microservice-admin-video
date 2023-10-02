<?php

namespace Core\Domain\Repository;

interface TransactionInterface
{
    public function commit(): void;

    public function rollback(): void;
}
