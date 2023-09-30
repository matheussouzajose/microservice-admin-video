<?php

namespace Core\Domain\UseCases\CastMember;

use Core\Intermediate\Dtos\CastMember\DeleteCastMemberInputDto;
use Core\Intermediate\Dtos\CastMember\DeleteCastMemberOutputDto;

interface DeleteCastMemberUseCaseInterface
{
    public function execute(DeleteCastMemberInputDto $input): DeleteCastMemberOutputDto;
}
