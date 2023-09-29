<?php

namespace Core\Application\UseCases\Genre\Delete\DTO;

class DeleteGenreOutputDto
{
    public function __construct(
        public bool $success
    ) {
    }
}
