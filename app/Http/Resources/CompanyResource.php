<?php

namespace App\Http\Resources;

use App\Http\Resources\Collections\ProjectCollection;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

/**
 * @mixin Company
 */
class CompanyResource extends JsonResource
{
    public static $wrap = 'list';
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
            'projects' =>  new ProjectCollection($this->projects),
        ];
    }
}
