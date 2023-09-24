<?php

namespace Core\Data\UseCases\Video\Delete\DTO;

class DeleteVideoInputDto
{
    /**
     * @param string $id
     */
    public function __construct(
        public string $id
    ) {
    }
}
