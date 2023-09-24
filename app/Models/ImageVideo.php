<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImageVideo extends Model
{
    use HasFactory, UuidTrait;

    /**
     * @var string
     */
    protected $table = 'images_video';

    /** @var string[] */
    protected $fillable = [
        'path',
        'type',
    ];

    /** @var bool */
    public $incrementing = false;

    /** @var string[] */
    protected $casts = [
        'id' => 'string',
        'is_active' => 'boolean',
        'deleted_at' => 'datetime',
    ];
    /**
     * @return BelongsTo
     */
    public function videos(): BelongsTo
    {
        return $this->belongsTo(Video::class);
    }
}
