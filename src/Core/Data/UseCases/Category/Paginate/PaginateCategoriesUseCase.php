<?php

namespace Core\Data\UseCases\Category\Paginate;

use Core\Data\UseCases\Category\Paginate\DTO\PaginateCategoriesInputDto;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\Repository\PaginationInterface;

class PaginateCategoriesUseCase implements PaginateCategoriesUseCaseInterface
{
    /**
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository
    ) {
    }

    /**
     * @param PaginateCategoriesInputDto $input
     * @return PaginationInterface
     */
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
