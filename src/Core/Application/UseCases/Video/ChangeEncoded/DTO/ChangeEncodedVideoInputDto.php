<?php

namespace Core\Application\UseCases\Video\ChangeEncoded\DTO;

class ChangeEncodedVideoInputDto
{
    public function __construct(
        public string $id,
        public string $encodedPath,
    ) {
    }
}
