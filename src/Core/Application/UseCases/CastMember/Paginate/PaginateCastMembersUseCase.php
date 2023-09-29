<?php

namespace Core\Application\UseCases\CastMember\Paginate;

use Core\Application\UseCases\CastMember\Paginate\DTO\PaginateCastMembersInputDto;
use Core\Domain\Repository\CastMemberRepositoryInterface;
use Core\Domain\Repository\PaginationInterface;

class PaginateCastMembersUseCase implements PaginateCastMembersUseCaseInterface
{
    public function __construct(protected CastMemberRepositoryInterface $repository)
    {
    }

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
