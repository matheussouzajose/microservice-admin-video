<?php

namespace App\Http\Controllers\Api\Genre;

use App\Http\Controllers\Controller;
use Core\Data\UseCases\Genre\Delete\DeleteGenreUseCaseInterface;
use Core\Data\UseCases\Genre\List\DTO\ListGenreInputDto;
use Illuminate\Http\Response;

class DeleteGenreController extends Controller
{
    /**
     * @param DeleteGenreUseCaseInterface $useCase
     */
    public function __construct(private readonly DeleteGenreUseCaseInterface $useCase)
    {
    }

    /**
     * @param $id
     * @return Response
     */
    public function __invoke($id): Response
    {
        $this->useCase->execute(new ListGenreInputDto(
            id: $id
        ));

        return response()->noContent();
    }
}
