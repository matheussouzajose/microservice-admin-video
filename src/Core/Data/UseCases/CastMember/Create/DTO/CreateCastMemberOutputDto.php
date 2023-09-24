<?php

namespace Core\Data\UseCases\CastMember\Create\DTO;

class CreateCastMemberOutputDto
{
    /**
     * @param string $id
     * @param string $name
     * @param int $type
     * @param string $created_at
     */
    public function __construct(
        public string $id,
        public string $name,
        public int $type,
        public string $created_at,
    ) {
    }
}
