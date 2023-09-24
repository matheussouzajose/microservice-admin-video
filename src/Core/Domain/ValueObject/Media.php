<?php

namespace Core\Domain\ValueObject;

use Core\Domain\Enum\MediaStatus;

class Media
{
    /**
     * @param string $filePath
     * @param MediaStatus $mediaStatus
     * @param string $encodedPath
     */
    public function __construct(
        protected string $filePath,
        protected MediaStatus $mediaStatus,
        protected string $encodedPath = '',
    ) {
    }

    /**
     * @param $property
     * @return mixed
     */
    public function __get($property)
    {
        return $this->{$property};
    }
}
