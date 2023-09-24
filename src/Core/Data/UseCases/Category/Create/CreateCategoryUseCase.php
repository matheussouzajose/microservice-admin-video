<?php

namespace Core\Data\UseCases\Category\Create;

use Core\Data\UseCases\Category\Create\DTO\CreateCategoryInputDto;
use Core\Data\UseCases\Category\Create\DTO\CreateCategoryOutputDto;
use Core\Domain\Entity\Category;
use Core\Domain\Exception\NotificationException;
use Core\Domain\Repository\CategoryRepositoryInterface;

class CreateCategoryUseCase implements CreateCategoryUseCaseInterface
{
    /**
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository
    ) {
    }

    /**
     * @param CreateCategoryInputDto $input
     * @return CreateCategoryOutputDto
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
