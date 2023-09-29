<?php

namespace Core\Application\UseCases\Video\ChangeEncoded\DTO;

class ChangeEncodedVideoOutputDto
{
    public function __construct(
        public string $id,
        public string $encodedPath,
    ) {
    }
}
