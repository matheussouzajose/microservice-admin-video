<?php

namespace Core\Data\UseCases\Video\Update\DTO;

use Core\Domain\Enum\Rating;

class UpdateVideoOutputDto
{
    /**
     * @param string $id
     * @param string $title
     * @param string $description
     * @param int $yearLaunched
     * @param int $duration
     * @param bool $opened
     * @param Rating $rating
     * @param string $createdAt
     * @param array $categories
     * @param array $genres
     * @param array $castMembers
     * @param string|null $videoFile
     * @param string|null $trailerFile
     * @param string|null $thumbFile
     * @param string|null $thumbHalf
     * @param string|null $bannerFile
     */
    public function __construct(
        public string $id,
        public string $title,
        public string $description,
        public int $yearLaunched,
        public int $duration,
        public bool $opened,
        public Rating $rating,
        public string $createdAt,
        public array $categories = [],
        public array $genres = [],
        public array $castMembers = [],
        public ?string $videoFile = null,
        public ?string $trailerFile = null,
        public ?string $thumbFile = null,
        public ?string $thumbHalf = null,
        public ?string $bannerFile = null,
    ) {
    }
}
