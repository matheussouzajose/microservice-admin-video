<?php

namespace Core\Application\UseCases\CastMember\List;

use Core\Application\UseCases\CastMember\List\DTO\ListCastMemberInputDto;
use Core\Application\UseCases\CastMember\List\DTO\ListCastMemberOutputDto;

interface ListCastMemberUseCaseInterface
{
    public function execute(ListCastMemberInputDto $input): ListCastMemberOutputDto;
}
