<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Company
 * @package App/Models
 * @property int $id
 * @property string $name
 * @property string $photo_url
 * @property string $description
 * @property-read mixed $projects
 */
class Company extends Model
{
    use HasFactory;
    public $table = 'company';
    protected $fillable = [
        'name',
        'photo_url',
        'description'
    ];

//    public function city(): BelongsTo
//    {
//        return $this->belongsTo(City::class);
//    }

    public function projects(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Project::class, 'company_id');
    }
}
