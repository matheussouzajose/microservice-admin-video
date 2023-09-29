<?php

namespace Core\Application\UseCases\Video\Create;

use Core\Application\UseCases\Video\Create\DTO\CreateVideoInputDto;
use Core\Application\UseCases\Video\Create\DTO\CreateVideoOutputDto;

interface CreateVideoUseCaseInterface
{
    public function execute(CreateVideoInputDto $input): CreateVideoOutputDto;
}
