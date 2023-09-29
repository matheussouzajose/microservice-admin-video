<?php

namespace Core\Application\UseCases\Video\ChangeEncoded;

use Core\Application\UseCases\Video\ChangeEncoded\DTO\ChangeEncodedVideoInputDto;
use Core\Application\UseCases\Video\ChangeEncoded\DTO\ChangeEncodedVideoOutputDto;

interface ChangeEncodedPathVideoUseCaseInterface
{
    public function execute(ChangeEncodedVideoInputDto $input): ChangeEncodedVideoOutputDto;
}
