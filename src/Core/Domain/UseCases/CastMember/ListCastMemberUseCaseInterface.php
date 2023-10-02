<?php

namespace Core\Domain\UseCases\CastMember;

use Core\Intermediate\Dtos\CastMember\ListCastMemberInputDto;
use Core\Intermediate\Dtos\CastMember\ListCastMemberOutputDto;

interface ListCastMemberUseCaseInterface
{
    public function execute(ListCastMemberInputDto $input): ListCastMemberOutputDto;
}
