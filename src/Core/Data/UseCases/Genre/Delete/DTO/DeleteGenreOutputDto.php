<?php

namespace Core\Data\UseCases\Genre\Delete\DTO;

class DeleteGenreOutputDto
{
    /**
     * @param bool $success
     */
    public function __construct(
        public bool $success
    ) {
    }
}
