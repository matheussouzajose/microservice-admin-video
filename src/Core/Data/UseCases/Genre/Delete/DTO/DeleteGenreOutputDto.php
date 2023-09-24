<?php

namespace Core\Data\UseCases\Genre\Delete\DTO;

class DeleteGenreOutputDto
{
    public function __construct(
        public bool $success
    ) {
    }
}
