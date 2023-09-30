<?php

namespace Core\Domain\UseCases\Genre;

use Core\Intermediate\Dtos\Genre\UpdateGenreInputDto;
use Core\Intermediate\Dtos\Genre\UpdateGenreOutputDto;

interface UpdateGenreUseCaseInterface
{
    public function execute(UpdateGenreInputDto $input): UpdateGenreOutputDto;
}
