<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @mixin City
 * @property int $id
 * @property string $name
 * @property-read mixed $country
 * @property-read mixed $companies
 */
class City extends Model
{
    use HasFactory;
    public $table = 'city';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'country_id'
    ];

    public function country(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function companies(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Company::class, 'city_id');
    }
}
