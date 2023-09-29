<?php

namespace Tests\Feature\Core\Application\UseCases\Category;

use App\Models\Category as CategoryModel;
use App\Repositories\Eloquent\CategoryEloquentRepository;
use Core\Application\UseCases\Category\Delete\DeleteCategoryUseCase;
use Core\Application\UseCases\Category\Delete\DTO\DeleteCategoryInputDto;
use Tests\TestCase;

class DeleteCategoryUseCaseFeatureTest extends TestCase
{
    public function testDelete()
    {
        $categoryDb = CategoryModel::factory()->create();

        $model = new CategoryModel();
        $repository = new CategoryEloquentRepository($model);
        $useCase = new DeleteCategoryUseCase($repository);

        $useCase->execute(
            new DeleteCategoryInputDto(
                id: $categoryDb->id
            )
        );

        $this->assertSoftDeleted($categoryDb);

    }
}
