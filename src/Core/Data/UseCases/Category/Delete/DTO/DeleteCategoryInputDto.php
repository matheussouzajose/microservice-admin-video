<?php

namespace Core\Data\UseCases\Category\Delete\DTO;

class DeleteCategoryInputDto
{
    /**
     * @param string $id
     */
    public function __construct(
        public string $id,
    ) {
    }
}
