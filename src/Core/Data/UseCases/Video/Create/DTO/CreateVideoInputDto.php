<?php

namespace Core\Data\UseCases\Video\Create\DTO;

use Core\Domain\Enum\Rating;

class CreateVideoInputDto
{
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
