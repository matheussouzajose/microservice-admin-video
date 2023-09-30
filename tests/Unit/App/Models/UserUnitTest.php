<?php

namespace Unit\App\Models;

use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tests\Unit\App\Models\ModelTestCase;

class UserUnitTest extends ModelTestCase
{
    protected function model(): Model
    {
        return new User();
    }

    /**
     * @return string[]
     */
    protected function traits(): array
    {
        return [
            HasApiTokens::class,
            HasFactory::class,
            Notifiable::class,
            SoftDeletes::class
        ];
    }

    /**
     * @return string[]
     */
    protected function fillables(): array
    {
        return [
            'id',
            'first_name',
            'last_name',
            'email',
            'password',
            'user_avatar',
            'email_verified_at',
            'created_at',
            'updated_at',
        ];
    }

    /**
     * @return string[]
     */
    protected function casts(): array
    {
        return [
            'id' => 'string',
            'email_verified_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }
}
