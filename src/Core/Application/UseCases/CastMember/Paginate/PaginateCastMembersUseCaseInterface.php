<?php

namespace Core\Application\UseCases\CastMember\Paginate;

use Core\Application\UseCases\CastMember\Paginate\DTO\PaginateCastMembersInputDto;
use Core\Domain\Repository\PaginationInterface;

interface PaginateCastMembersUseCaseInterface
{
    public function execute(PaginateCastMembersInputDto $input): PaginationInterface;
}
