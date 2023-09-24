<?php

namespace Tests\Stubs;

use Core\Data\UseCases\Interfaces\FileStorageInterface;

class UploadFilesStub implements FileStorageInterface
{
    public function __construct()
    {
        event($this);
    }

    /**
     * @param string $path
     * @param array $file
     * @return string
     */
    public function store(string $path, array $file): string
    {
        return "{$path}/test.mp4";
    }

    public function delete(string $path): void
    {
        //
    }
}

