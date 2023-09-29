<?php

namespace Core\Application\UseCases\Interfaces;

interface FileStorageInterface
{
    public function store(string $path, array $file): string;

    public function delete(string $path): void;
}
