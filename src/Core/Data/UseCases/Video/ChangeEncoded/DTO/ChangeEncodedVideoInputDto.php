<?php

namespace Core\Data\UseCases\Video\ChangeEncoded\DTO;

class ChangeEncodedVideoInputDto
{
    public function __construct(
        public string $id,
        public string $encodedPath,
    ) {
    }
}
