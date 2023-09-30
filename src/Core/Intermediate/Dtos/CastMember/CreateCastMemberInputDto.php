<?php

namespace Core\Intermediate\Dtos\CastMember;

class CreateCastMemberInputDto
{
    public function __construct(
        public string $name,
        public int $type,
    ) {
    }
}
