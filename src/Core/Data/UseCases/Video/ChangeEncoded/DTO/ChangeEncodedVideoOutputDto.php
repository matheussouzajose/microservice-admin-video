<?php

namespace Core\Data\UseCases\Video\ChangeEncoded\DTO;

class ChangeEncodedVideoOutputDto
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
