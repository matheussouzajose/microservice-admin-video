<?php

namespace Core\Data\UseCases\Genre\Update\DTO;

class UpdateGenreInputDto
{
    /**
     * @param string $id
     * @param string $name
     * @param array $categoriesId
     */
    public function __construct(
        public string $id,
        public string $name,
        public array $categoriesId = [],
    ) {
    }
}
