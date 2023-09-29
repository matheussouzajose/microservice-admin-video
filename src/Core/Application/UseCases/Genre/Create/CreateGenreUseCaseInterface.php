<?php

namespace Core\Application\UseCases\Genre\Create;

use Core\Application\UseCases\Genre\Create\DTO\CreateGenreInputDto;
use Core\Application\UseCases\Genre\Create\DTO\CreateGenreOutputDto;

interface CreateGenreUseCaseInterface
{
    public function execute(CreateGenreInputDto $input): CreateGenreOutputDto;
}
