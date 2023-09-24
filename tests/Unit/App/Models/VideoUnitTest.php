<?php

namespace Unit\App\Models;

use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tests\Unit\App\Models\ModelTestCase;

class VideoUnitTest extends ModelTestCase
{
    protected function model(): Model
    {
        return new Video();
    }

    /**
     * @return string[]
     */
    protected function traits(): array
    {
        return [
            HasFactory::class,
            SoftDeletes::class,
        ];
    }

    /**
     * @return string[]
     */
    protected function fillables(): array
    {
        return [
            'id',
            'title',
            'description',
            'year_launched',
            'opened',
            'rating',
            'duration',
            'created_at',
        ];
    }

    /**
     * @return string[]
     */
    protected function casts(): array
    {
        return [
            'id' => 'string',
            'is_active' => 'boolean',
            'deleted_at' => 'datetime',
        ];
    }
}
