<?php

namespace Core\Application\UseCases\Category\Update\DTO;

class UpdateCategoryInputDto
{
    public function __construct(
        public string $id,
        public string $name,
        public ?string $description = null,
        public bool $isActive = true,
    ) {
    }
}
