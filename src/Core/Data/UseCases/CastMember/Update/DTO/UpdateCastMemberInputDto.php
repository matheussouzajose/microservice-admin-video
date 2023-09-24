<?php

namespace Core\Data\UseCases\CastMember\Update\DTO;

class UpdateCastMemberInputDto
{
    public function __construct(
        public string $id,
        public string $name,
    ) {
    }
}
