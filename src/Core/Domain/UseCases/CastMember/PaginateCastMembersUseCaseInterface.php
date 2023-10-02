<?php

namespace Core\Domain\UseCases\CastMember;

use Core\Domain\Repository\PaginationInterface;
use Core\Intermediate\Dtos\CastMember\PaginateCastMembersInputDto;

interface PaginateCastMembersUseCaseInterface
{
    public function execute(PaginateCastMembersInputDto $input): PaginationInterface;
}
