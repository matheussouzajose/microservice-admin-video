<?php

namespace Core\Application\UseCases\CastMember\Delete\DTO;

class DeleteCastMemberOutputDto
{
    public function __construct(
        public bool $success
    ) {
    }
}
