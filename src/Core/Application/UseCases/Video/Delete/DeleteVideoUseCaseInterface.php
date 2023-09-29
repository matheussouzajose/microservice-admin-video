<?php

namespace Core\Application\UseCases\Video\Delete;

use Core\Application\UseCases\Video\Delete\DTO\DeleteVideoInputDto;
use Core\Application\UseCases\Video\Delete\DTO\DeleteVideoOutputDto;

interface DeleteVideoUseCaseInterface
{
    public function execute(DeleteVideoInputDto $input): DeleteVideoOutputDto;
}
