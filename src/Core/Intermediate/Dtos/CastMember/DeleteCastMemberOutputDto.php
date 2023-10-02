<?php

namespace Core\Intermediate\Dtos\CastMember;

class DeleteCastMemberOutputDto
{
    public function __construct(
        public bool $success
    ) {
    }
}
