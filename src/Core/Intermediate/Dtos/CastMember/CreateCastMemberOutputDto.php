<?php

namespace Core\Intermediate\Dtos\CastMember;

class CreateCastMemberOutputDto
{
    public function __construct(
        public string $id,
        public string $name,
        public int $type,
        public string $created_at,
    ) {
    }
}
