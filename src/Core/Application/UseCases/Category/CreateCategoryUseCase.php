<?php

namespace Core\Application\UseCases\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Exception\NotificationException;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\UseCases\Category\CreateCategoryUseCaseInterface;
use Core\Intermediate\Dtos\Category\CreateCategoryInputDto;
use Core\Intermediate\Dtos\Category\CreateCategoryOutputDto;

class CreateCategoryUseCase implements CreateCategoryUseCaseInterface
{
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository
    ) {
    }

    /**
     * @throws NotificationException
     */
    public function execute(CreateCategoryInputDto $input): CreateCategoryOutputDto
    {
        $entity = new Category(
            name: $input->name,
            description: $input->description,
            isActive: $input->isActive
        );

        $newCategory = $this->categoryRepository->insert($entity);

        return new CreateCategoryOutputDto(
            id: $newCategory->id(),
            name: $newCategory->name,
            description: $newCategory->description,
            is_active: $newCategory->isActive,
            created_at: $newCategory->createdAt()
        );
    }
}
