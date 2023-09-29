<?php

namespace Core\Application\UseCases\Category\Delete\DTO;

class DeleteCategoryInputDto
{
    public function __construct(
        public string $id,
    ) {
    }
}
