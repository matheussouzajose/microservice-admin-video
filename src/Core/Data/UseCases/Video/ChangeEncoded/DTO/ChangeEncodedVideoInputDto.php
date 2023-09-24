<?php

namespace Core\Data\UseCases\Video\ChangeEncoded\DTO;

class ChangeEncodedVideoInputDto
{
    /**
     * @param string $id
     * @param string $encodedPath
     */
    public function __construct(
        public string $id,
        public string $encodedPath,
    ) {
    }
}
