<?php

namespace Core\Intermediate\Dtos\Genre;

class UpdateGenreInputDto
{
    public function __construct(
        public string $id,
        public string $name,
        public array $categoriesId = [],
    ) {
    }
}
