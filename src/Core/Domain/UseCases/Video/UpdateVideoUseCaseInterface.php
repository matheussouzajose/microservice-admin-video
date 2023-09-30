<?php

namespace Core\Domain\UseCases\Video;

use Core\Intermediate\Dtos\Video\UpdateVideoInputDto;
use Core\Intermediate\Dtos\Video\UpdateVideoOutputDto;

interface UpdateVideoUseCaseInterface
{
    public function execute(UpdateVideoInputDto $input): UpdateVideoOutputDto;
}
