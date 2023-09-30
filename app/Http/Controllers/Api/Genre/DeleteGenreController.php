<?php

namespace App\Http\Controllers\Api\Genre;

use App\Http\Controllers\Controller;
use Core\Domain\UseCases\Genre\DeleteGenreUseCaseInterface;
use Core\Intermediate\Dtos\Genre\ListGenreInputDto;
use Illuminate\Http\Response;

class DeleteGenreController extends Controller
{
    public function __construct(private readonly DeleteGenreUseCaseInterface $useCase)
    {
    }

    public function __invoke($id): Response
    {
        $this->useCase->execute(new ListGenreInputDto(
            id: $id
        ));

        return response()->noContent();
    }
}
