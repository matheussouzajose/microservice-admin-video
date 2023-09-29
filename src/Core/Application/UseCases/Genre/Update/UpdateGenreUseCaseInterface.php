<?php

namespace Core\Application\UseCases\Genre\Update;

use Core\Application\UseCases\Genre\Update\DTO\UpdateGenreInputDto;
use Core\Application\UseCases\Genre\Update\DTO\UpdateGenreOutputDto;

interface UpdateGenreUseCaseInterface
{
    public function execute(UpdateGenreInputDto $input): UpdateGenreOutputDto;
}
