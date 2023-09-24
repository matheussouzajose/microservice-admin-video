<?php

namespace Core\Data\UseCases\Category\List\DTO;

class ListCategoryInputDto
{
    /**
     * @param string $id
     */
    public function __construct(
        public string $id,
    ) {
    }
}
