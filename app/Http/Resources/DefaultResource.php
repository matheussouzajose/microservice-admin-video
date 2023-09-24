<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DefaultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     */
    public function toArray($request): array|\JsonSerializable|Arrayable
    {
        return collect($this->resource)
            ->mapWithKeys(function ($value, $key) {
                $key = trim(strtolower(preg_replace('/[A-Z]/', '_$0', $key)));

                return [
                    $key => $value,
                ];
            });
    }
}
