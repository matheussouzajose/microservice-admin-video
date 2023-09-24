<?php

namespace App\Http\Controllers\Api\Video;

use App\Adapters\ApiAdapter;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateVideoRequest;
use Core\Data\UseCases\Video\Update\DTO\UpdateVideoInputDto;
use Core\Data\UseCases\Video\Update\UpdateVideoUseCase;
use Core\Domain\Exception\NotificationException;
use Illuminate\Http\JsonResponse;

class UpdateVideoController extends Controller
{
    /**
     * @param UpdateVideoUseCase $useCase
     */
    public function __construct(private readonly  UpdateVideoUseCase $useCase)
    {
    }

    /**
     * @param UpdateVideoRequest $request
     * @param $id
     * @return JsonResponse
     * @throws NotificationException
     * @throws \Throwable
     */
    public function __invoke(UpdateVideoRequest $request, $id): JsonResponse
    {
        $response = $this->useCase->execute(
            input: new UpdateVideoInputDto(
                id: $id,
                title: $request->title,
                description: $request->description,
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

        return ApiAdapter::json($response);
    }
}
