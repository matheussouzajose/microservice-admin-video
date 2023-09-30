<?php

namespace Core\Domain\UseCases\Video;

use Core\Intermediate\Dtos\Video\ListVideoInputDto;
use Core\Intermediate\Dtos\Video\ListVideoOutputDto;

interface ListVideoUseCaseInterface
{
    public function execute(ListVideoInputDto $input): ListVideoOutputDto;
}
