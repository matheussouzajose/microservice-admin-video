<?php

namespace Core\Domain\Builder\Video;

use Core\Domain\Entity\Video;
use Core\Domain\Enum\MediaStatus;
use Core\Domain\Exception\NotificationException;
use Core\Domain\ValueObject\Image;
use Core\Domain\ValueObject\Media;

class BuilderVideo implements BuilderVideoInterface
{
    protected ?Video $entity = null;

    public function __construct()
    {
        $this->reset();
    }

    private function reset(): void
    {
        $this->entity = null;
    }

    /**
     * @throws NotificationException
     */
    public function createEntity(object $input): BuilderVideoInterface
    {
        $this->entity = new Video(
            title: $input->title,
            description: $input->description,
            yearLaunched: $input->yearLaunched,
            duration: $input->duration,
            opened: true,
            rating: $input->rating,
        );

        $this->addIds($input);

        return $this;
    }

    public function addIds(object $input): void
    {
        foreach ($input->categories as $categoryId) {
            $this->entity->addCategoryId($categoryId);
        }

        foreach ($input->genres as $genreId) {
            $this->entity->addGenre($genreId);
        }

        foreach ($input->castMembers as $castMemberId) {
            $this->entity->addCastMember($castMemberId);
        }
    }

    public function addMediaVideo(string $path, MediaStatus $mediaStatus, string $encodedPath = ''): BuilderVideoInterface
    {
        $media = new Media(
            filePath: $path,
            mediaStatus: $mediaStatus,
            encodedPath: $encodedPath
        );
        $this->entity->setVideoFile($media);

        return $this;
    }

    public function addThumb(string $path): BuilderVideoInterface
    {
        $this->entity->setThumbFile(new Image(
            path: $path
        ));

        return $this;
    }

    public function addThumbHalf(string $path): BuilderVideoInterface
    {
        $this->entity->setThumbHalf(new Image(
            path: $path
        ));

        return $this;
    }

    public function addBanner(string $path): BuilderVideoInterface
    {
        $this->entity->setBannerFile(new Image(
            path: $path
        ));

        return $this;
    }

    public function addTrailer(string $path): BuilderVideoInterface
    {
        $media = new Media(
            filePath: $path,
            mediaStatus: MediaStatus::COMPLETE
        );
        $this->entity->setTrailerFile($media);

        return $this;
    }

    public function getEntity(): Video
    {
        return $this->entity;
    }
}
