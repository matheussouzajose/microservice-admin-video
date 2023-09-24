<?php

namespace Core\Data\UseCases\CastMember\Create\DTO;

class CreateCastMemberInputDto
{
    /**
     * @param string $name
     * @param int $type
     */
    public function __construct(
        public string $name,
        public int $type,
    ) {
    }
}
