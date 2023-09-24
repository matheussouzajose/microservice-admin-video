<?php

namespace Core\Data\UseCases\CastMember\Update\DTO;

class UpdateCastMemberInputDto
{
    /**
     * @param string $id
     * @param string $name
     */
    public function __construct(
        public string $id,
        public string $name,
    ) {
    }
}
