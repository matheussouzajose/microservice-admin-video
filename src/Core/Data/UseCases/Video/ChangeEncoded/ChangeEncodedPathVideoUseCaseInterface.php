<?php

namespace Core\Data\UseCases\Video\ChangeEncoded;

use Core\Data\UseCases\Video\ChangeEncoded\DTO\ChangeEncodedVideoInputDto;
use Core\Data\UseCases\Video\ChangeEncoded\DTO\ChangeEncodedVideoOutputDto;

interface ChangeEncodedPathVideoUseCaseInterface
{
    public function execute(ChangeEncodedVideoInputDto $input): ChangeEncodedVideoOutputDto;
}
