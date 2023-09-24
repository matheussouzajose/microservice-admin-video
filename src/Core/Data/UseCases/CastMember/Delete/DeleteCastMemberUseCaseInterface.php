<?php

namespace Core\Data\UseCases\CastMember\Delete;

use Core\Data\UseCases\CastMember\Delete\DTO\DeleteCastMemberInputDto;
use Core\Data\UseCases\CastMember\Delete\DTO\DeleteCastMemberOutputDto;

interface DeleteCastMemberUseCaseInterface
{
    public function execute(DeleteCastMemberInputDto $input): DeleteCastMemberOutputDto;
}
