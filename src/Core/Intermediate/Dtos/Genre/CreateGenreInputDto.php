<?php

namespace Core\Intermediate\Dtos\Genre;

class CreateGenreInputDto
{
    public function __construct(
        public string $name,
        public array $categoriesId = [],
        public bool $isActive = true,
    ) {
    }
}
