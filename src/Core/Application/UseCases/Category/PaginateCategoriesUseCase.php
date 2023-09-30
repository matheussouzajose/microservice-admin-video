<?php

namespace Core\Application\UseCases\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\Repository\PaginationInterface;
use Core\Domain\UseCases\Category\PaginateCategoriesUseCaseInterface;
use Core\Intermediate\Dtos\Category\PaginateCategoriesInputDto;

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
