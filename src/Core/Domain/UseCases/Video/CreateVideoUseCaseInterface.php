<?php

namespace Core\Domain\UseCases\Video;

use Core\Intermediate\Dtos\Video\CreateVideoInputDto;
use Core\Intermediate\Dtos\Video\CreateVideoOutputDto;

interface CreateVideoUseCaseInterface
{
    public function execute(CreateVideoInputDto $input): CreateVideoOutputDto;
}
