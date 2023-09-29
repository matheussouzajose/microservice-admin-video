<?php

namespace Core\Application\UseCases\Interfaces;

interface HasherInterface
{
    public function hash(string $plaintext): string;

    public function compare(string $plaintext, string $hashed): bool;
}
