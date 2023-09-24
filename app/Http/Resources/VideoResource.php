<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class VideoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     */
    public function toArray($request): array|\JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'year_launched' => $this->year_launched ?? $this->yearLaunched,
            'opened' => $this->opened,
            'rating' => $this->rating,
            'duration' => $this->duration,
            'created_at' => $this->created_at ?? $this->createdAt,
            'video' => $this->videoFile ?? '',
            'trailer' => $this->trailerFile ?? '',
            'banner' => $this->bannerFile ?? '',
            'thumb' => $this->thumbFile ? Storage::url($this->thumbFile) : '',
            'thumb_half' => $this->thumbHalfFile ?? '',
            'categories' => $this->categories,
            'genres' => $this->genres,
            'cast_members' => $this->cast_members ?? $this->castMembers ?? [],
        ];
    }
}
