<?php

namespace Core\Domain\UseCases\Genre;

use Core\Intermediate\Dtos\Genre\CreateGenreInputDto;
use Core\Intermediate\Dtos\Genre\CreateGenreOutputDto;

interface CreateGenreUseCaseInterface
{
    public function execute(CreateGenreInputDto $input): CreateGenreOutputDto;
}
