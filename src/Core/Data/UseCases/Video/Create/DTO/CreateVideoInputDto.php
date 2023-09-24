<?php

namespace Core\Data\UseCases\Video\Create\DTO;

use Core\Domain\Enum\Rating;

class CreateVideoInputDto
{
    /**
     * @param string $title
     * @param string $description
     * @param int $yearLaunched
     * @param int $duration
     * @param bool $opened
     * @param Rating $rating
     * @param array $categories
     * @param array $genres
     * @param array $castMembers
     * @param array|null $videoFile
     * @param array|null $trailerFile
     * @param array|null $thumbFile
     * @param array|null $thumbHalf
     * @param array|null $bannerFile
     */
    public function __construct(
        public string $title,
        public string $description,
        public int $yearLaunched,
        public int $duration,
        public bool $opened,
        public Rating $rating,
        public array $categories,
        public array $genres,
        public array $castMembers,
        public ?array $videoFile = null,
        public ?array $trailerFile = null,
        public ?array $thumbFile = null,
        public ?array $thumbHalf = null,
        public ?array $bannerFile = null,
    ) {
    }
}
