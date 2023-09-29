<?php

namespace Core\Application\UseCases\Video\List;

use Core\Application\UseCases\Video\List\DTO\ListVideoInputDto;
use Core\Application\UseCases\Video\List\DTO\ListVideoOutputDto;

interface ListVideoUseCaseInterface
{
    public function execute(ListVideoInputDto $input): ListVideoOutputDto;
}
