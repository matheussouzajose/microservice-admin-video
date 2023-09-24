<?php

namespace Core\Data\UseCases\Category\Create\DTO;

class CreateCategoryInputDto
{
    /**
     * @param string $name
     * @param string $description
     * @param bool $isActive
     */
    public function __construct(
        public string $name,
        public string $description = '',
        public bool $isActive = true,
    ) {
    }
}
