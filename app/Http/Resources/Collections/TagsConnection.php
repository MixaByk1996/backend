<?php

namespace App\Http\Resources\Collections;

use App\Http\Resources\TagsResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class TagsConnection extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function toArray(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return TagsResource::collection($this->collection);
    }
}
