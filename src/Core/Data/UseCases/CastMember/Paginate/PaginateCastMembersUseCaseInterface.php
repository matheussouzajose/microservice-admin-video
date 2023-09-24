<?php

namespace Core\Data\UseCases\CastMember\Paginate;

use Core\Data\UseCases\CastMember\Paginate\DTO\PaginateCastMembersInputDto;
use Core\Domain\Repository\PaginationInterface;

interface PaginateCastMembersUseCaseInterface
{
    /**
     * @param PaginateCastMembersInputDto $input
     * @return PaginationInterface
     */
    public function execute(PaginateCastMembersInputDto $input): PaginationInterface;
}