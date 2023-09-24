<?php

namespace Tests\Unit\App\Models;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GenreUnitTest extends ModelTestCase
{
    protected function model(): Model
    {
        return new Genre();
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
            'name',
            'is_active',
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
