<?php

namespace Core\Data\UseCases\Video\Update;

use Core\Data\UseCases\Video\Update\DTO\UpdateVideoInputDto;
use Core\Data\UseCases\Video\Update\DTO\UpdateVideoOutputDto;

interface UpdateVideoUseCaseInterface
{
    public function execute(UpdateVideoInputDto $input): UpdateVideoOutputDto;
}
