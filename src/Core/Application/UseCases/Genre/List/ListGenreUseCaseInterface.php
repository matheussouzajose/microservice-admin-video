<?php

namespace Core\Application\UseCases\Genre\List;

use Core\Application\UseCases\Genre\List\DTO\ListGenreInputDto;
use Core\Application\UseCases\Genre\List\DTO\ListGenreOutputDto;

interface ListGenreUseCaseInterface
{
    public function execute(ListGenreInputDto $input): ListGenreOutputDto;
}
