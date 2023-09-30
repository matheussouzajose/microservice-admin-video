<?php

namespace Core\Intermediate\Dtos\Genre;

class CreateGenreOutputDto
{
    public function __construct(
        public string $id,
        public string $name,
        public bool $is_active,
        public string $created_at = '',
    ) {
    }
}
