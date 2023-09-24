<?php

namespace Core\Data\UseCases\Genre\Create\DTO;

class CreateGenreInputDto
{
    public function __construct(
        public string $name,
        public array $categoriesId = [],
        public bool $isActive = true,
    ) {
    }
}
