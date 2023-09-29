<?php

namespace Core\Application\UseCases\Video\Update;

use Core\Application\UseCases\Video\BaseVideoUseCase;
use Core\Application\UseCases\Video\Update\DTO\UpdateVideoInputDto;
use Core\Application\UseCases\Video\Update\DTO\UpdateVideoOutputDto;
use Core\Domain\Builder\Video\BuilderVideo;
use Core\Domain\Builder\Video\UpdateVideoBuilder;
use Core\Domain\Exception\NotificationException;

class UpdateVideoUseCase extends BaseVideoUseCase implements UpdateVideoUseCaseInterface
{
    protected function getBuilder(): BuilderVideo
    {
        return new UpdateVideoBuilder;
    }

    /**
     * @throws NotificationException
     * @throws \Throwable
     */
    public function execute(UpdateVideoInputDto $input): UpdateVideoOutputDto
    {
        $this->validateAllIds($input);

        $entity = $this->repository->findById($input->id);
        $entity->update(
            title: $input->title,
            description: $input->description,
        );

        $this->builder->setEntity($entity);
        $this->builder->addIds($input);

        try {
            $this->repository->update($this->builder->getEntity());

            $this->storageFiles($input);

            $this->repository->updateMedia($this->builder->getEntity());

            $this->transaction->commit();

            return $this->output();

        } catch (\Throwable $th) {
            $this->transaction->rollback();

            throw $th;
        }
    }

    private function output(): UpdateVideoOutputDto
    {
        $entity = $this->builder->getEntity();

        return new UpdateVideoOutputDto(
            id: $entity->id(),
            title: $entity->title,
            description: $entity->description,
            yearLaunched: $entity->yearLaunched,
            duration: $entity->duration,
            opened: $entity->opened,
            rating: $entity->rating,
            createdAt: $entity->createdAt(),
            categories: $entity->categoriesId,
            genres: $entity->genresId,
            castMembers: $entity->castMemberIds,
            videoFile: $entity->videoFile()?->filePath,
            trailerFile: $entity->trailerFile()?->filePath,
            thumbFile: $entity->thumbFile()?->path(),
            thumbHalf: $entity->thumbHalf()?->path(),
            bannerFile: $entity->bannerFile()?->path(),
        );
    }
}
