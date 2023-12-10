<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property-read mixed $files
 * @property-read mixed $project
 * @property-read mixed $tags
 */
class Subproject extends Model
{
    use HasFactory;

    protected $table = 'subproject';
    protected $fillable = [
        'name',
        'description',
        'project_id'
    ];
    protected $casts = [
        'created_at' => 'datetime'
    ];

    public function files(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Files::class, 'filestable');
    }

    public function tags(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Tags::class, 'tagstable');
    }

    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

}
