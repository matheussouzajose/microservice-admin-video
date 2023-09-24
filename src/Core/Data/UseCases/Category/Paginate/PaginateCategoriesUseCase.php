<?php

namespace Core\Data\UseCases\Category\Paginate;

use Core\Data\UseCases\Category\Paginate\DTO\PaginateCategoriesInputDto;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\Repository\PaginationInterface;

class PaginateCategoriesUseCase implements PaginateCategoriesUseCaseInterface
{
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository
    ) {
    }

    public function execute(PaginateCategoriesInputDto $input): PaginationInterface
    {
        return $this->categoryRepository->paginate(
            filter: $input->filter,
            order: $input->order,
            page: $input->page,
            totalPage: $input->totalPage
        );
    }
}
