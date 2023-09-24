<?php

namespace Core\Data\UseCases\CastMember\List\DTO;

class ListCastMemberInputDto
{
    /**
     * @param string $id
     */
    public function __construct(
        public string $id
    ) {
    }
}
