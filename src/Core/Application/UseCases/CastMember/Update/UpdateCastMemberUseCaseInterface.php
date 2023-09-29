<?php

namespace Core\Application\UseCases\CastMember\Update;

use Core\Application\UseCases\CastMember\Update\DTO\UpdateCastMemberInputDto;
use Core\Application\UseCases\CastMember\Update\DTO\UpdateCastMemberOutputDto;

interface UpdateCastMemberUseCaseInterface
{
    public function execute(UpdateCastMemberInputDto $input): UpdateCastMemberOutputDto;
}
