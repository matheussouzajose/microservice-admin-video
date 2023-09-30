<?php

namespace Core\Application\UseCases\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\UseCases\Category\ListCategoryUseCaseInterface;
use Core\Intermediate\Dtos\Category\ListCategoryInputDto;
use Core\Intermediate\Dtos\Category\ListCategoryOutputDto;

class ListCategoryUseCase implements ListCategoryUseCaseInterface
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    ) {
    }

    public function execute(ListCategoryInputDto $input): ListCategoryOutputDto
    {
        $category = $this->categoryRepository->findById($input->id);

        return new ListCategoryOutputDto(
            id: $category->id(),
            name: $category->name,
            description: $category->description,
            is_active: $category->isActive,
            created_at: $category->createdAt()
        );
    }
}
