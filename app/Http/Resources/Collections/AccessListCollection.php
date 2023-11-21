<?php

namespace App\Http\Resources\Collections;

use App\Http\Resources\AccessListResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AccessListCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function toArray(Request $request): AnonymousResourceCollection
    {
        return AccessListResource::collection($this->collection);
    }
}
