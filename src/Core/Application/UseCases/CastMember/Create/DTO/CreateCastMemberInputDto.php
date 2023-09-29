<?php

namespace Core\Application\UseCases\CastMember\Create\DTO;

class CreateCastMemberInputDto
{
    public function __construct(
        public string $name,
        public int $type,
    ) {
    }
}
