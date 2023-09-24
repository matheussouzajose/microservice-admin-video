<?php

namespace Core\Data\UseCases\Genre\List\DTO;

class ListGenreInputDto
{
    /**
     * @param string $id
     */
    public function __construct(
        public string $id = '',
    ) {
    }
}
