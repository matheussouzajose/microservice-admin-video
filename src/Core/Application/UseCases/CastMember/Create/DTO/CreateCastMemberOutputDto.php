<?php

namespace Core\Application\UseCases\CastMember\Create\DTO;

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
