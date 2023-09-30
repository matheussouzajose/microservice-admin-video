<?php

namespace Feature\Core\Application\UseCases\Video;

use Core\Application\UseCases\Video\CreateVideoUseCase;
use Core\Domain\Enum\Rating;
use Core\Intermediate\Dtos\Video\CreateVideoInputDto;

class CreateVideoUseCaseTest extends BaseVideoUseCaseTest
{
    public function useCase(): string
    {
        return CreateVideoUseCase::class;
    }

    public function inputDTO(
        array $categories = [],
        array $genres = [],
        array $castMembers = [],
        array $videoFile = null,
        array $trailerFile = null,
        array $bannerFile = null,
        array $thumbFile = null,
        array $thumbHalf = null,
    ): object {
        return new CreateVideoInputDto(
            title: 'test',
            description: 'test',
            yearLaunched: 2020,
            duration: 120,
            opened: true,
            rating: Rating::L,
            categories: $categories,
            genres: $genres,
            castMembers: $castMembers,
            videoFile: $videoFile,
            trailerFile: $trailerFile,
            thumbFile: $thumbFile,
            thumbHalf: $thumbHalf,
            bannerFile: $bannerFile,
        );
    }
}
