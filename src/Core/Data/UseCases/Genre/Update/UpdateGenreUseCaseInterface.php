<?php

namespace Core\Data\UseCases\Genre\Update;

use Core\Data\UseCases\Genre\Update\DTO\UpdateGenreInputDto;
use Core\Data\UseCases\Genre\Update\DTO\UpdateGenreOutputDto;

interface UpdateGenreUseCaseInterface
{
    /**
     * @param UpdateGenreInputDto $input
     * @return UpdateGenreOutputDto
     */
    public function execute(UpdateGenreInputDto $input): UpdateGenreOutputDto;
}
