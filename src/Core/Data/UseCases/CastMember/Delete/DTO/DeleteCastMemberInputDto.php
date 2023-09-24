<?php

namespace Core\Data\UseCases\CastMember\Delete\DTO;

class DeleteCastMemberInputDto
{
    /**
     * @param string $id
     */
    public function __construct(
        public string $id
    ) {
    }
}
