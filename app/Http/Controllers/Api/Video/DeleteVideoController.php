<?php

namespace App\Http\Controllers\Api\Video;

use App\Http\Controllers\Controller;
use Core\Application\UseCases\Video\DeleteVideoUseCase;
use Core\Intermediate\Dtos\Video\DeleteVideoInputDto;
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
