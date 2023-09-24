<?php

namespace Core\Data\UseCases\Video\Create;
use Core\Data\UseCases\Video\Create\DTO\CreateVideoInputDto;
use Core\Data\UseCases\Video\Create\DTO\CreateVideoOutputDto;

interface CreateVideoUseCaseInterface
{
    public function execute(CreateVideoInputDto $input): CreateVideoOutputDto;
}
