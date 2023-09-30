<?php

namespace Core\Application\UseCases\Genre;

use Core\Domain\Repository\GenreRepositoryInterface;
use Core\Domain\Repository\PaginationInterface;
use Core\Domain\UseCases\Genre\PaginateGenresUseCaseInterface;
use Core\Intermediate\Dtos\Genre\PaginateGenresInputDto;

class PaginateGenresUseCase implements PaginateGenresUseCaseInterface
{
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
