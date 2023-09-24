<?php

namespace Core\Data\UseCases\CastMember\Delete\DTO;

class DeleteCastMemberInputDto
{
    public function __construct(
        public string $id
    ) {
    }
}
