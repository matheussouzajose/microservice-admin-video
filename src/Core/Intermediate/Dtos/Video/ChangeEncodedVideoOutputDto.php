<?php

namespace Core\Intermediate\Dtos\Video;

class ChangeEncodedVideoOutputDto
{
    public function __construct(
        public string $id,
        public string $encodedPath,
    ) {
    }
}
