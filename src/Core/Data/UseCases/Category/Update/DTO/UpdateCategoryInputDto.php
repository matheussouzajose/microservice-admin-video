<?php

namespace Core\Data\UseCases\Category\Update\DTO;

class UpdateCategoryInputDto
{
    /**
     * @param string $id
     * @param string $name
     * @param string|null $description
     * @param bool $isActive
     */
    public function __construct(
        public string $id,
        public string $name,
        public string|null $description = null,
        public bool $isActive = true,
    ) {
    }
}
