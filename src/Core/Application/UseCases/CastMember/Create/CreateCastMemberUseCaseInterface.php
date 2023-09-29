<?php

namespace Core\Application\UseCases\CastMember\Create;

use Core\Application\UseCases\CastMember\Create\DTO\CreateCastMemberInputDto;
use Core\Application\UseCases\CastMember\Create\DTO\CreateCastMemberOutputDto;

interface CreateCastMemberUseCaseInterface
{
    public function execute(CreateCastMemberInputDto $input): CreateCastMemberOutputDto;
}
