<?php

namespace Core\Application\UseCases\Category\Create\DTO;

class CreateCategoryInputDto
{
    public function __construct(
        public string $name,
        public string $description = '',
        public bool $isActive = true,
    ) {
    }
}