<?php

namespace Core\Data\UseCases\Genre\List\DTO;

class ListGenreInputDto
{
    public function __construct(
        public string $id = '',
    ) {
    }
}
