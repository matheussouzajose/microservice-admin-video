<?php

namespace Core\Data\UseCases\Category\List\DTO;

class ListCategoryOutputDto
{
    /**
     * @param string $id
     * @param string $name
     * @param string $description
     * @param bool $is_active
     * @param string $created_at
     */
    public function __construct(
        public string $id,
        public string $name,
        public string $description = '',
        public bool $is_active = true,
        public string $created_at = ''
    ) {
    }
}
