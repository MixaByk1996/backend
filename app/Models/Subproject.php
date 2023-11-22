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
 */
class Subproject extends Model
{
    use HasFactory;

    protected $table = 'subproject';
    protected $fillable = [
        'name',
        'description'
    ];
    protected $casts = [
        'created_at' => 'datetime'
    ];

    public function files(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Files::class, 'subproject_id');
    }

    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
