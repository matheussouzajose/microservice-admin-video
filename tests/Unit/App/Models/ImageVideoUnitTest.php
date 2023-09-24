<?php

namespace Unit\App\Models;

use App\Models\ImageVideo;
use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tests\Unit\App\Models\ModelTestCase;

class ImageVideoUnitTest extends ModelTestCase
{
    /**
     * @return Model
     */
    protected function model(): Model
    {
        return new ImageVideo();
    }

    /**
     * @return string[]
     */
    protected function traits(): array
    {
        return [
            HasFactory::class,
            UuidTrait::class
        ];
    }

    /**
     * @return string[]
     */
    protected function fillables(): array
    {
        return [
            'path',
            'type',
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
