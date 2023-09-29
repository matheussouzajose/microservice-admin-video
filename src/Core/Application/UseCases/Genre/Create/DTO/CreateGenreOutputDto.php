<?php

namespace Core\Application\UseCases\Genre\Create\DTO;

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
