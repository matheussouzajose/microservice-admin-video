<?php

namespace Core\Application\UseCases\CastMember\Update\DTO;

class UpdateCastMemberInputDto
{
    public function __construct(
        public string $id,
        public string $name,
    ) {
    }
}
