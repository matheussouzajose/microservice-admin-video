<?php

namespace Core\Domain\ValueObject;

class Image
{
    /**
     * @param string $path
     */
    public function __construct(
        protected string $path,
    ) {
    }

    /**
     * @return string
     */
    public function path(): string
    {
        return $this->path;
    }
}
