<?php

namespace Core\Data\UseCases\Video\List\DTO;

class ListVideoInputDto
{
    /**
     * @param string $id
     */
    public function __construct(
        public string $id
    ) {
    }
}
