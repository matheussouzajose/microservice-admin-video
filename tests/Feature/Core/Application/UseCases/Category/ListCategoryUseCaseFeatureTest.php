<?php

namespace Tests\Feature\Core\Application\UseCases\Category;

use App\Models\Category as CategoryModel;
use App\Repositories\Eloquent\CategoryEloquentRepository;
use Core\Application\UseCases\Category\ListCategoryUseCase;
use Core\Intermediate\Dtos\Category\ListCategoryInputDto;
use Tests\TestCase;

class ListCategoryUseCaseFeatureTest extends TestCase
{
    public function testListCategory()
    {
        $categoryDb = CategoryModel::factory()->create();

        $model = new CategoryModel();
        $repository = new CategoryEloquentRepository($model);
        $useCase = new ListCategoryUseCase($repository);
        $response = $useCase->execute(new ListCategoryInputDto(id: $categoryDb->id));

        $this->assertEquals($categoryDb->id, $response->id);
        $this->assertEquals($categoryDb->name, $response->name);
        $this->assertEquals($categoryDb->description, $response->description);
    }
}
