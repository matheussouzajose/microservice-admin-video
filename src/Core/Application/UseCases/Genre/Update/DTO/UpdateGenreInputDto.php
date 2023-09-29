<?php

namespace Core\Application\UseCases\Genre\Update\DTO;

class UpdateGenreInputDto
{
    public function __construct(
        public string $id,
        public string $name,
        public array $categoriesId = [],
    ) {
    }
}
