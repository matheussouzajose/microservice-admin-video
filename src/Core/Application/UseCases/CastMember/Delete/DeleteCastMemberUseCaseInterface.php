<?php

namespace Core\Application\UseCases\CastMember\Delete;

use Core\Application\UseCases\CastMember\Delete\DTO\DeleteCastMemberInputDto;
use Core\Application\UseCases\CastMember\Delete\DTO\DeleteCastMemberOutputDto;

interface DeleteCastMemberUseCaseInterface
{
    public function execute(DeleteCastMemberInputDto $input): DeleteCastMemberOutputDto;
}
