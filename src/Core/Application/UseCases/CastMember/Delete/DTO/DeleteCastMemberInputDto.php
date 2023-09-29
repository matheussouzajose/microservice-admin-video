<?php

namespace Core\Application\UseCases\CastMember\Delete\DTO;

class DeleteCastMemberInputDto
{
    public function __construct(
        public string $id
    ) {
    }
}
