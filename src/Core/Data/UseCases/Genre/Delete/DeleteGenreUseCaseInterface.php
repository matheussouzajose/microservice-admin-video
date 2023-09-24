<?php

namespace Core\Data\UseCases\Genre\Delete;

use Core\Data\UseCases\Genre\Delete\DTO\DeleteGenreOutputDto;
use Core\Data\UseCases\Genre\List\DTO\ListGenreInputDto;

interface DeleteGenreUseCaseInterface
{
    public function execute(ListGenreInputDto $input): DeleteGenreOutputDto;
}
