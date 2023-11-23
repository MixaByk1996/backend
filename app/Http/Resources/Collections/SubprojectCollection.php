<?php

namespace App\Http\Resources\Collections;

use App\Http\Resources\SubprojectResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SubprojectCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function toArray(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return SubprojectResource::collection($this->collection);
    }
}
