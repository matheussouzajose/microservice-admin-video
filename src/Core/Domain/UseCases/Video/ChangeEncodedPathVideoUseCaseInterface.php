<?php

namespace Core\Domain\UseCases\Video;

use Core\Intermediate\Dtos\Video\ChangeEncodedVideoInputDto;
use Core\Intermediate\Dtos\Video\ChangeEncodedVideoOutputDto;

interface ChangeEncodedPathVideoUseCaseInterface
{
    public function execute(ChangeEncodedVideoInputDto $input): ChangeEncodedVideoOutputDto;
}
