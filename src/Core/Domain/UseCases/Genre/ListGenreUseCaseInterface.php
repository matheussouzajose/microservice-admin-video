<?php

namespace Core\Domain\UseCases\Genre;

use Core\Intermediate\Dtos\Genre\ListGenreInputDto;
use Core\Intermediate\Dtos\Genre\ListGenreOutputDto;

interface ListGenreUseCaseInterface
{
    public function execute(ListGenreInputDto $input): ListGenreOutputDto;
}
