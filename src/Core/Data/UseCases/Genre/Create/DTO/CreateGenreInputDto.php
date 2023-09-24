<?php

namespace Core\Data\UseCases\Genre\Create\DTO;

class CreateGenreInputDto
{
    /**
     * @param string $name
     * @param array $categoriesId
     * @param bool $isActive
     */
    public function __construct(
        public string $name,
        public array $categoriesId = [],
        public bool $isActive = true,
    ) {
    }
}
