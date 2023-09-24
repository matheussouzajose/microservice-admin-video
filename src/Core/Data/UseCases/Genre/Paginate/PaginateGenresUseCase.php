<?php

namespace Core\Data\UseCases\Genre\Paginate;


use Core\Data\UseCases\Genre\Paginate\DTO\PaginateGenresInputDto;
use Core\Domain\Repository\GenreRepositoryInterface;
use Core\Domain\Repository\PaginationInterface;

class PaginateGenresUseCase implements PaginateGenresUseCaseInterface
{
    /**
     * @param GenreRepositoryInterface $repository
     */
    public function __construct(
        protected GenreRepositoryInterface $repository
    ) {
    }

    public function execute(PaginateGenresInputDto $input): PaginationInterface
    {
        return $this->repository->paginate(
            filter: $input->filter,
            order: $input->order,
            page: $input->page,
            totalPage: $input->totalPage,
        );
    }
}
