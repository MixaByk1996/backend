<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string $file_url
 * @property-read mixed $filestable
 */
class Files extends Model
{
    use HasFactory;

    protected $table = 'files';
    protected $fillable = [
        'name',
        'type',
        'file_url'
    ];

    protected $casts = [
        'created_at' => 'datetime'
    ];

    public function filestable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }


}
