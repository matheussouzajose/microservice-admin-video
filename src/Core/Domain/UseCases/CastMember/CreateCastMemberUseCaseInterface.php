<?php

namespace Core\Domain\UseCases\CastMember;

use Core\Intermediate\Dtos\CastMember\CreateCastMemberInputDto;
use Core\Intermediate\Dtos\CastMember\CreateCastMemberOutputDto;

interface CreateCastMemberUseCaseInterface
{
    public function execute(CreateCastMemberInputDto $input): CreateCastMemberOutputDto;
}
