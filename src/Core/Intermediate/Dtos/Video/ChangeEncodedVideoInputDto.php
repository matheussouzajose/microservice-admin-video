<?php

namespace Core\Intermediate\Dtos\Video;

class ChangeEncodedVideoInputDto
{
    public function __construct(
        public string $id,
        public string $encodedPath,
    ) {
    }
}
