<?php

namespace Unit\Core\Data\UseCases\Video;

use Core\Data\UseCases\Video\Create\CreateVideoUseCase;
use Core\Data\UseCases\Video\Create\DTO\CreateVideoInputDto;
use Core\Data\UseCases\Video\Create\DTO\CreateVideoOutputDto;
use Core\Domain\Enum\Rating;

class CreateVideoUseCaseUnitTest extends BaseVideoUseCaseUnitTest
{
    public function test_exec_input_output()
    {
        $this->createUseCase();

        $response = $this->useCase->execute(
            input: $this->createMockInputDTO(),
        );

        $this->assertInstanceOf(CreateVideoOutputDto::class, $response);
    }

    protected function nameActionRepository(): string
    {
        return 'insert';
    }

    protected function getUseCase(): string
    {
        return CreateVideoUseCase::class;
    }

    protected function createMockInputDTO(
        array $categoriesIds = [],
        array $genresIds = [],
        array $castMembersIds = [],
        ?array $videoFile = null,
        ?array $trailerFile = null,
        ?array $thumbFile = null,
        ?array $thumbHalf = null,
        ?array $bannerFile = null,
    ): CreateVideoInputDto {
        return \Mockery::mock(CreateVideoInputDto::class, [
            'title',
            'desc',
            2023,
            12,
            true,
            Rating::RATE10,
            $categoriesIds,
            $genresIds,
            $castMembersIds,
            $videoFile,
            $trailerFile,
            $thumbFile,
            $thumbHalf,
            $bannerFile,
        ]);
    }
}
