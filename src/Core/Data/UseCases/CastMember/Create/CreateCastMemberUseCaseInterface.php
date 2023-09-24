<?php

namespace Core\Data\UseCases\CastMember\Create;

use Core\Data\UseCases\CastMember\Create\DTO\CreateCastMemberInputDto;
use Core\Data\UseCases\CastMember\Create\DTO\CreateCastMemberOutputDto;

interface CreateCastMemberUseCaseInterface
{
    public function execute(CreateCastMemberInputDto $input): CreateCastMemberOutputDto;
}
