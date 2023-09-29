<?php

namespace Core\Application\UseCases\Category\List;

use Core\Application\UseCases\Category\List\DTO\ListCategoryInputDto;
use Core\Application\UseCases\Category\List\DTO\ListCategoryOutputDto;
use Core\Domain\Repository\CategoryRepositoryInterface;

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
