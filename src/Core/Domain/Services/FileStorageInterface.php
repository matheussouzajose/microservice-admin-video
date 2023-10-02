<?php

namespace Core\Domain\Services;

interface FileStorageInterface
{
    public function store(string $path, array $file): string;

    public function delete(string $path): void;
}
