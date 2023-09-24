<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CastMember extends Model
{
    use HasFactory, SoftDeletes;

    /** @var string[] */
    protected $fillable = [
        'id',
        'name',
        'type',
        'created_at',
    ];

    /** @var bool */
    public $incrementing = false;

    /** @var string[] */
    protected $casts = [
        'id' => 'string',
        'deleted_at' => 'datetime',
    ];

    public function videos(): BelongsToMany
    {
        return $this->belongsToMany(Video::class);
    }
}
