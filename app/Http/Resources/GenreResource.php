<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GenreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'is_active' =>  $this->is_active,
            'created_at' => Carbon::make($this->created_at)->format('Y-m-d H:i:s'),
            'categories' => CategoryResource::collection(convertArrayToObjects($this->categories))
        ];
    }
}
