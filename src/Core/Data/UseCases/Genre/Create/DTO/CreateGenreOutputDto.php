<?php

namespace Core\Data\UseCases\Genre\Create\DTO;

class CreateGenreOutputDto
{
    /**
     * @param string $id
     * @param string $name
     * @param bool $is_active
     * @param string $created_at
     */
    public function __construct(
        public string $id,
        public string $name,
        public bool $is_active,
        public string $created_at = '',
    ) {
    }
}
