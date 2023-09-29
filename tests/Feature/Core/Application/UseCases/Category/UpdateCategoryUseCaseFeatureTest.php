<?php

namespace Tests\Feature\Core\Application\UseCases\Category;

use App\Models\Category as CategoryModel;
use App\Repositories\Eloquent\CategoryEloquentRepository;
use Core\Application\UseCases\Category\Update\DTO\UpdateCategoryInputDto;
use Core\Application\UseCases\Category\Update\UpdateCategoryUseCase;
use Tests\TestCase;

class UpdateCategoryUseCaseFeatureTest extends TestCase
{
    public function testDelete()
    {
        $categoryDb = CategoryModel::factory()->create();

        $model = new CategoryModel();
        $repository = new CategoryEloquentRepository($model);
        $useCase = new UpdateCategoryUseCase($repository);

        $result = $useCase->execute(
            new UpdateCategoryInputDto(
                id: $categoryDb->id,
                name: 'Updated Name'
            )
        );

        $this->assertEquals($categoryDb->id, $result->id);
        $this->assertEquals('Updated Name', $result->name);
        $this->assertEquals($categoryDb->description, $result->description);

        $this->assertDatabaseHas('categories', [
            'name' => 'Updated Name',
        ]);
    }
}
