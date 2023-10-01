<?php

namespace Tests\Stubs;

use Core\Application\UseCases\Interfaces\HasherInterface;

class HasherStub implements HasherInterface
{
    public function __construct()
    {
        event($this);
    }

    public function hash(string $plaintext): string
    {
        return 'plaintext_hashed';
    }

    public function compare(string $plaintext, string $hashed): bool
    {
        return true;
    }
}
