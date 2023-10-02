<?php

namespace Core\Domain\UseCases\CastMember;

use Core\Intermediate\Dtos\CastMember\UpdateCastMemberInputDto;
use Core\Intermediate\Dtos\CastMember\UpdateCastMemberOutputDto;

interface UpdateCastMemberUseCaseInterface
{
    public function execute(UpdateCastMemberInputDto $input): UpdateCastMemberOutputDto;
}
