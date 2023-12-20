<?php

namespace App\Http\Resources\Collections;

use App\Http\Resources\TemplatesListResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TemplatesListCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return AnonymousResourceCollection
     */
    public function toArray(Request $request): AnonymousResourceCollection
    {
        return TemplatesListResource::collection($this->collection);
    }
}
