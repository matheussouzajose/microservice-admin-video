<?php

namespace Core\Data\UseCases\Genre\Update;

use Core\Data\UseCases\Genre\Update\DTO\UpdateGenreInputDto;
use Core\Data\UseCases\Genre\Update\DTO\UpdateGenreOutputDto;

interface UpdateGenreUseCaseInterface
{
    public function execute(UpdateGenreInputDto $input): UpdateGenreOutputDto;
}
