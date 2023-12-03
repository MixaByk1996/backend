<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property int $id
 * @property string $name
 * @property-read mixed $tagstable
 */
class Tags extends Model
{
    use HasFactory;
    protected $table = 'tags';

    protected $fillable = [
        'name',
        'tagstable_id',
        'tagstable_type'
    ];

    public function tagstable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }
}
