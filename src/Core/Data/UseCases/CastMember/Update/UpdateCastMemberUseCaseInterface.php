<?php

namespace Core\Data\UseCases\CastMember\Update;

use Core\Data\UseCases\CastMember\Update\DTO\UpdateCastMemberInputDto;
use Core\Data\UseCases\CastMember\Update\DTO\UpdateCastMemberOutputDto;


interface UpdateCastMemberUseCaseInterface
{
    /**
     * @param UpdateCastMemberInputDto $input
     * @return UpdateCastMemberOutputDto
     */
    public function execute(UpdateCastMemberInputDto $input): UpdateCastMemberOutputDto;
}
