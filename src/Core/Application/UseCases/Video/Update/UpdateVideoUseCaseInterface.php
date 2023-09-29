<?php

namespace Core\Application\UseCases\Video\Update;

use Core\Application\UseCases\Video\Update\DTO\UpdateVideoInputDto;
use Core\Application\UseCases\Video\Update\DTO\UpdateVideoOutputDto;

interface UpdateVideoUseCaseInterface
{
    public function execute(UpdateVideoInputDto $input): UpdateVideoOutputDto;
}
