<?php

namespace Core\Data\UseCases\Genre\List;

use Core\Data\UseCases\Genre\List\DTO\ListGenreInputDto;
use Core\Data\UseCases\Genre\List\DTO\ListGenreOutputDto;

interface ListGenreUseCaseInterface
{
    public function execute(ListGenreInputDto $input): ListGenreOutputDto;
}
