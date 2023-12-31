<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    /** @var string[] */
    protected $fillable = [
        'id',
        'name',
        'description',
        'is_active',
    ];

    /** @var bool */
    public $incrementing = false;

    /** @var string[] */
    protected $casts = [
        'id' => 'string',
        'is_active' => 'boolean',
    ];

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    public function videos(): BelongsToMany
    {
        return $this->belongsToMany(Video::class);
    }
}
