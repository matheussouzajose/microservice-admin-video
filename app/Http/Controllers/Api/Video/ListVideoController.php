<?php

namespace App\Http\Controllers\Api\Video;

use App\Http\Controllers\Controller;
use App\Http\Resources\VideoResource;
use Core\Application\UseCases\Video\ListVideoUseCase;
use Core\Intermediate\Dtos\Video\ListVideoInputDto;
use Illuminate\Http\JsonResponse;

class ListVideoController extends Controller
{
    public function __construct(private readonly ListVideoUseCase $useCase)
    {
    }

    public function __invoke($id): JsonResponse
    {
        $response = $this->useCase->execute(
            input: new ListVideoInputDto(
                id: $id
            )
        );

        return (new VideoResource($response))->response();
        //        return ApiAdapter::json($response);
    }
}
