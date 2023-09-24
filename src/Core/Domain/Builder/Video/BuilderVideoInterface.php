<?php

namespace Core\Domain\Builder\Video;

use Core\Domain\Entity\Video as Entity;
use Core\Domain\Enum\MediaStatus;

interface BuilderVideoInterface
{
    public function createEntity(object $input): BuilderVideoInterface;

    public function addMediaVideo(string $path, MediaStatus $mediaStatus, string $encodedPath = ''): BuilderVideoInterface;

    public function addTrailer(string $path): BuilderVideoInterface;

    public function addThumb(string $path): BuilderVideoInterface;

    public function addThumbHalf(string $path): BuilderVideoInterface;

    public function addBanner(string $path): BuilderVideoInterface;

    public function getEntity(): Entity;
}
