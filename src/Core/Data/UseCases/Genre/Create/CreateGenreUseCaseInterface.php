<?php

namespace Core\Data\UseCases\Genre\Create;

use Core\Data\UseCases\Genre\Create\DTO\CreateGenreInputDto;
use Core\Data\UseCases\Genre\Create\DTO\CreateGenreOutputDto;

interface CreateGenreUseCaseInterface
{
    /**
     * @param CreateGenreInputDto $input
     * @return CreateGenreOutputDto
     */
    public function execute(CreateGenreInputDto $input): CreateGenreOutputDto;
}
