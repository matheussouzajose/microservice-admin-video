<?php

namespace Core\Application\UseCases\Genre\Create\DTO;

class CreateGenreInputDto
{
    public function __construct(
        public string $name,
        public array $categoriesId = [],
        public bool $isActive = true,
    ) {
    }
}
