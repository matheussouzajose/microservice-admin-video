<?php

namespace Core\Application\UseCases\CastMember;

use Core\Domain\Repository\CastMemberRepositoryInterface;
use Core\Domain\Repository\PaginationInterface;
use Core\Domain\UseCases\CastMember\PaginateCastMembersUseCaseInterface;
use Core\Intermediate\Dtos\CastMember\PaginateCastMembersInputDto;

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
