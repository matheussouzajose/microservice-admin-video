<?php

namespace Core\Domain\Builder\Video;

use Core\Domain\Entity\Video as Entity;
use Core\Domain\Enum\MediaStatus;

interface BuilderVideoInterface
{
    /**
     * @param object $input
     * @return BuilderVideoInterface
     */
    public function createEntity(object $input): BuilderVideoInterface;

    /**
     * @param string $path
     * @param MediaStatus $mediaStatus
     * @param string $encodedPath
     * @return BuilderVideoInterface
     */
    public function addMediaVideo(string $path, MediaStatus $mediaStatus, string $encodedPath = ''): BuilderVideoInterface;

    /**
     * @param string $path
     * @return BuilderVideoInterface
     */
    public function addTrailer(string $path): BuilderVideoInterface;

    /**
     * @param string $path
     * @return BuilderVideoInterface
     */
    public function addThumb(string $path): BuilderVideoInterface;

    /**
     * @param string $path
     * @return BuilderVideoInterface
     */
    public function addThumbHalf(string $path): BuilderVideoInterface;

    /**
     * @param string $path
     * @return BuilderVideoInterface
     */
    public function addBanner(string $path): BuilderVideoInterface;

    /**
     * @return Entity
     */
    public function getEntity(): Entity;
}
