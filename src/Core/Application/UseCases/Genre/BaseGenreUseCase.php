<?php

namespace Core\Application\UseCases\Genre;

use Core\Application\UseCases\Interfaces\TransactionInterface;
use Core\Domain\Builder\Genre\GenreBuilderInterface;
use Core\Domain\Exception\NotFoundException;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\Repository\GenreRepositoryInterface;

abstract class BaseGenreUseCase
{
    protected GenreBuilderInterface $builder;

    public function __construct(
        protected GenreRepositoryInterface $repository,
        protected TransactionInterface $transaction,
        protected CategoryRepositoryInterface $categoryRepository,
    ) {
        $this->builder = $this->getBuilder();
    }

    abstract protected function getBuilder(): GenreBuilderInterface;

    /**
     * @throws NotFoundException
     */
    protected function validateAllIds(object $input): void
    {
        $this->validateIds(
            ids: $input->categoriesId,
            repository: $this->categoryRepository,
            singularLabel: 'Category',
            pluralLabel: 'Categories'
        );
    }

    /**
     * @throws NotFoundException
     */
    protected function validateIds(array $ids, $repository, string $singularLabel, string $pluralLabel = null): void
    {
        $idsDb = $repository->getIdsByEntitiesIds($ids);

        $arrayDiff = array_diff($ids, $idsDb);

        if (count($arrayDiff)) {
            $msg = sprintf(
                '%s %s not found',
                count($arrayDiff) > 1 ? $pluralLabel ?? $singularLabel.'s' : $singularLabel,
                implode(', ', $arrayDiff)
            );

            throw new NotFoundException($msg);
        }
    }
}
