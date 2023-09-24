<?php

namespace Core\Data\UseCases\Video\List;

use Core\Data\UseCases\Video\List\DTO\ListVideoInputDto;
use Core\Data\UseCases\Video\List\DTO\ListVideoOutputDto;

interface ListVideoUseCaseInterface
{
    public function execute(ListVideoInputDto $input): ListVideoOutputDto;
}
