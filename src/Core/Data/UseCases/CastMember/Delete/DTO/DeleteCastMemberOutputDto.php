<?php

namespace Core\Data\UseCases\CastMember\Delete\DTO;

class DeleteCastMemberOutputDto
{
    /**
     * @param bool $success
     */
    public function __construct(
        public bool $success
    ) {
    }
}
