<?php

namespace App\Http\Controllers\Api\Video;

use App\Http\Controllers\Controller;
use Core\Application\UseCases\Video\Delete\DeleteVideoUseCase;
use Core\Application\UseCases\Video\Delete\DTO\DeleteVideoInputDto;
use Illuminate\Http\Response;

class DeleteVideoController extends Controller
{
    public function __construct(private readonly DeleteVideoUseCase $useCase)
    {
    }

    public function __invoke($id): Response
    {
        $this->useCase->execute(new DeleteVideoInputDto(id: $id));

        return response()->noContent();
    }
}
