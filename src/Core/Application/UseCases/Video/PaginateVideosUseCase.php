<?php

namespace Core\Application\UseCases\Video;

use Core\Domain\Repository\PaginationInterface;
use Core\Domain\Repository\VideoRepositoryInterface;
use Core\Domain\UseCases\Video\PaginateVideosUseCaseInterface;
use Core\Intermediate\Dtos\Video\PaginateVideosInputDto;

class PaginateVideosUseCase implements PaginateVideosUseCaseInterface
{
    public function __construct(
        private VideoRepositoryInterface $repository
    ) {
    }

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
