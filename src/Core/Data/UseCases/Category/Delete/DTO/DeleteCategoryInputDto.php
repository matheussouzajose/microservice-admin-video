<?php

namespace Core\Data\UseCases\Category\Delete\DTO;

class DeleteCategoryInputDto
{
    public function __construct(
        public string $id,
    ) {
    }
}
