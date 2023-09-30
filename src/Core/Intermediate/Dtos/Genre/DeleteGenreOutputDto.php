<?php

namespace Core\Intermediate\Dtos\Genre;

class DeleteGenreOutputDto
{
    public function __construct(
        public bool $success
    ) {
    }
}
