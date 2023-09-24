<?php

namespace Core\Data\UseCases\Video\Delete;

use Core\Data\UseCases\Video\Delete\DTO\DeleteVideoInputDto;
use Core\Data\UseCases\Video\Delete\DTO\DeleteVideoOutputDto;

interface DeleteVideoUseCaseInterface
{
    public function execute(DeleteVideoInputDto $input): DeleteVideoOutputDto;
}
