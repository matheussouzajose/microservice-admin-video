<?php

namespace Core\Data\UseCases\CastMember\List;

use Core\Data\UseCases\CastMember\List\DTO\ListCastMemberInputDto;
use Core\Data\UseCases\CastMember\List\DTO\ListCastMemberOutputDto;

interface ListCastMemberUseCaseInterface
{
    /**
     * @param ListCastMemberInputDto $input
     * @return ListCastMemberOutputDto
     */
    public function execute(ListCastMemberInputDto $input): ListCastMemberOutputDto;
}
