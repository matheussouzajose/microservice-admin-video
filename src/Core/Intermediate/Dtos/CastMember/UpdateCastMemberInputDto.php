<?php

namespace Core\Intermediate\Dtos\CastMember;

class UpdateCastMemberInputDto
{
    public function __construct(
        public string $id,
        public string $name,
    ) {
    }
}
