<?php

namespace Tests\Feature\Core\Application\UseCases\Category;

use App\Models\Category as CategoryModel;
use App\Repositories\Eloquent\CategoryEloquentRepository;
use Core\Application\UseCases\Category\CreateCategoryUseCase;
use Core\Intermediate\Dtos\Category\CreateCategoryInputDto;
use Tests\TestCase;

class CreateCategoryUseCaseFeatureTest extends TestCase
{
    public function testCreate()
    {
        $model = new CategoryModel();
        $repository = new CategoryEloquentRepository($model);
        $useCase = new CreateCategoryUseCase($repository);

        $responseUseCase = $useCase->execute(
            new CreateCategoryInputDto(
                name: 'New Category'
            )
        );

        $this->assertEquals('New Category', $responseUseCase->name);
        $this->assertNotEmpty($responseUseCase->id);

        $this->assertDatabaseHas('categories', [
            'id' => $responseUseCase->id,
        ]);
    }
}
