<?php

namespace App\Http\Controllers\Api\Video;

use App\Adapters\ApiAdapter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVideoRequest;
use Core\Application\UseCases\Video\CreateVideoUseCase;
use Core\Domain\Enum\Rating;
use Core\Domain\Exception\NotificationException;
use Core\Intermediate\Dtos\Video\CreateVideoInputDto;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreateVideoController extends Controller
{
    public function __construct(private readonly CreateVideoUseCase $useCase)
    {
    }

    /**
     * @throws NotificationException
     * @throws \Throwable
     */
    public function __invoke(StoreVideoRequest $request): JsonResponse
    {
        $response = $this->useCase->execute(
            input: new CreateVideoInputDto(
                title: $request->title,
                description: $request->description,
                yearLaunched: $request->year_launched,
                duration: $request->duration,
                opened: $request->opened,
                rating: Rating::from($request->rating),
                categories: $request->categories,
                genres: $request->genres,
                castMembers: $request->cast_members,
                videoFile: getArrayFile($request->file('video_file')),
                trailerFile: getArrayFile($request->file('trailer_file')),
                thumbFile: getArrayFile($request->file('thumb_file')),
                thumbHalf: getArrayFile($request->file('thumb_half_file')),
                bannerFile: getArrayFile($request->file('banner_file')),
            )
        );

        return ApiAdapter::json($response, Response::HTTP_CREATED);
    }
}
