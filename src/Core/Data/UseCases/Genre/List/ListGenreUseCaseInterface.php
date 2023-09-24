<?php

namespace Core\Data\UseCases\Genre\List;

use Core\Data\UseCases\Genre\List\DTO\ListGenreInputDto;
use Core\Data\UseCases\Genre\List\DTO\ListGenreOutputDto;

interface ListGenreUseCaseInterface
{
    /**
     * @param ListGenreInputDto $input
     * @return ListGenreOutputDto
     */
    public function execute(ListGenreInputDto $input): ListGenreOutputDto;
}
