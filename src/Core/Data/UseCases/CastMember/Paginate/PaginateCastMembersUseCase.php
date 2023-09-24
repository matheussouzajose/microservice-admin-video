<?php

namespace Core\Data\UseCases\CastMember\Paginate;

use Core\Data\UseCases\CastMember\Paginate\DTO\PaginateCastMembersInputDto;
use Core\Domain\Repository\CastMemberRepositoryInterface;
use Core\Domain\Repository\PaginationInterface;

class PaginateCastMembersUseCase implements PaginateCastMembersUseCaseInterface
{
    /**
     * @param CastMemberRepositoryInterface $repository
     */
    public function __construct(protected CastMemberRepositoryInterface $repository)
    {
    }

    /**
     * @param PaginateCastMembersInputDto $input
     * @return PaginationInterface
     */
    public function execute(PaginateCastMembersInputDto $input): PaginationInterface
    {
        return $this->repository->paginate(
            filter: $input->filter,
            order: $input->order,
            page: $input->page,
            totalPage: $input->totalPerPage,
        );
    }
}
