<?php

namespace Core\Application\UseCases\Video;

use Core\Application\UseCases\Interfaces\FileStorageInterface;
use Core\Application\UseCases\Interfaces\TransactionInterface;
use Core\Application\UseCases\Video\Interfaces\VideoEventManagerInterface;
use Core\Domain\Builder\Video\BuilderVideo;
use Core\Domain\Enum\MediaStatus;
use Core\Domain\Event\VideoCreatedEvent;
use Core\Domain\Exception\NotFoundException;
use Core\Domain\Repository\CastMemberRepositoryInterface;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\Repository\GenreRepositoryInterface;
use Core\Domain\Repository\VideoRepositoryInterface;

abstract class BaseVideoUseCase
{
    protected BuilderVideo $builder;

    public function __construct(
        protected VideoRepositoryInterface $repository,
        protected TransactionInterface $transaction,
        protected FileStorageInterface $storage,
        protected VideoEventManagerInterface $eventManager,
        protected CategoryRepositoryInterface $categoryRepository,
        protected GenreRepositoryInterface $genreRepository,
        protected CastMemberRepositoryInterface $castMemberRepository
    ) {
        $this->builder = $this->getBuilder();
    }

    abstract protected function getBuilder(): BuilderVideo;

    protected function storageFiles(object $input): void
    {
        $entity = $this->builder->getEntity();
        $path = $entity->id();

        if ($pathVideoFile = $this->storageFile($path, $input->videoFile)) {
            $this->builder->addMediaVideo($pathVideoFile, MediaStatus::PROCESSING);
            $this->eventManager->dispatch(new VideoCreatedEvent($entity));
        }

        if ($pathTrailerFile = $this->storageFile($path, $input->trailerFile)) {
            $this->builder->addTrailer($pathTrailerFile);
        }

        if ($pathThumbFile = $this->storageFile($path, $input->thumbFile)) {
            $this->builder->addThumb($pathThumbFile);
        }

        if ($pathThumbHalfFile = $this->storageFile($path, $input->thumbHalf)) {
            $this->builder->addThumbHalf($pathThumbHalfFile);
        }

        if ($pathBannerFile = $this->storageFile($path, $input->bannerFile)) {
            $this->builder->addBanner($pathBannerFile);
        }
    }

    private function storageFile(string $path, array $media = null): ?string
    {
        if ($media) {
            return $this->storage->store(
                path: $path,
                file: $media
            );
        }

        return null;
    }

    /**
     * @throws NotFoundException
     */
    protected function validateAllIds(object $input): void
    {
        $this->validateIds(
            ids: $input->categories,
            repository: $this->categoryRepository,
            singularLabel: 'Category',
            pluralLabel: 'Categories'
        );

        $this->validateIds(
            ids: $input->genres,
            repository: $this->genreRepository,
            singularLabel: 'Genre',
        );

        $this->validateIds(
            ids: $input->castMembers,
            repository: $this->castMemberRepository,
            singularLabel: 'Cast Member',
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
