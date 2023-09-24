<?php

namespace Core\Data\UseCases\Interfaces;

interface FileStorageInterface
{
    /**
     * @param string $path
     * @param array $file
     * @return string
     */
    public function store(string $path, array $file): string;

    /**
     * @param string $path
     * @return void
     */
    public function delete(string $path): void;
}
