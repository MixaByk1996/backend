<?php

namespace App\Http\Resources;

use App\Http\Resources\Collections\SubprojectCollection;
use App\Http\Resources\Collections\TagsConnection;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Project
 */
class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'subproject' => new SubprojectCollection($this->subprojects),
            'files' => $this->files,
            'company' => $this->company,
            'tags' => $this->tags
        ];
    }
}
