<?php

namespace Core\Data\UseCases\Video\Paginate;

use Core\Data\UseCases\Video\Paginate\DTO\PaginateVideosInputDto;
use Core\Domain\Repository\PaginationInterface;
use Core\Domain\Repository\VideoRepositoryInterface;

class PaginateVideosUseCase implements PaginateVideosUseCaseInterface
{
    /**
     * @param VideoRepositoryInterface $repository
     */
    public function __construct(
        private VideoRepositoryInterface $repository
    ) {
    }

    /**
     * @param PaginateVideosInputDto $input
     * @return PaginationInterface
     */
    public function execute(PaginateVideosInputDto $input): PaginationInterface
    {
        return $this->repository->paginate(
            filter: $input->filter,
            order: $input->order,
            page: $input->page,
            totalPage: $input->totalPerPage
        );
    }
}