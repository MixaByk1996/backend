<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property-read mixed $company
 * @property-read mixed $subprojects
 * @property-read mixed $files
 */
class Project extends Model
{
    use HasFactory;

    protected $table = 'project';
    protected $fillable = [
        'name',
        'description'
    ];
    protected $casts = [
        'created_at' => 'datetime'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function subprojects(): HasMany
    {
        return $this->hasMany(Subproject::class, 'project_id');
    }

    public function files(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Files::class, 'filestable');
    }


}
