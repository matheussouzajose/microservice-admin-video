<?php

namespace Core\Domain\UseCases\Genre;

use Core\Intermediate\Dtos\Genre\DeleteGenreOutputDto;
use Core\Intermediate\Dtos\Genre\ListGenreInputDto;

interface DeleteGenreUseCaseInterface
{
    public function execute(ListGenreInputDto $input): DeleteGenreOutputDto;
}
