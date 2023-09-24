<?php

namespace App\Http\Controllers\Api\Video;

use App\Http\Controllers\Controller;
use Core\Data\UseCases\Video\Delete\DeleteVideoUseCase;
use Core\Data\UseCases\Video\Delete\DTO\DeleteVideoInputDto;
use Illuminate\Http\Response;

class DeleteVideoController extends Controller
{
    /**
     * @param DeleteVideoUseCase $useCase
     */
    public function __construct(private readonly DeleteVideoUseCase $useCase)
    {
    }

    /**
     * @param $id
     * @return Response
     */
    public function __invoke($id): Response
    {
        $this->useCase->execute(new DeleteVideoInputDto(id: $id));
        return response()->noContent();
    }
}
