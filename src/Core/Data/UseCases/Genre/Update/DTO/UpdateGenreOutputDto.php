<?php

namespace Core\Data\UseCases\Genre\Update\DTO;

class UpdateGenreOutputDto
{
    public function __construct(
        public string $id,
        public string $name,
        public bool $is_active,
        public string $created_at = '',
    ) {
    }
}
