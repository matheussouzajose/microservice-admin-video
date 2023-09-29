<?php

namespace Core\Application\UseCases\Genre\Delete;

use Core\Application\UseCases\Genre\Delete\DTO\DeleteGenreOutputDto;
use Core\Application\UseCases\Genre\List\DTO\ListGenreInputDto;

interface DeleteGenreUseCaseInterface
{
    public function execute(ListGenreInputDto $input): DeleteGenreOutputDto;
}
