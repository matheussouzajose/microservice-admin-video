<?php

namespace Core\Domain\UseCases\Video;

use Core\Intermediate\Dtos\Video\DeleteVideoInputDto;
use Core\Intermediate\Dtos\Video\DeleteVideoOutputDto;

interface DeleteVideoUseCaseInterface
{
    public function execute(DeleteVideoInputDto $input): DeleteVideoOutputDto;
}
