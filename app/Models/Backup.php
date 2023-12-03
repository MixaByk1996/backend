<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Class Backup
 * @package App/Models
 * @property int $id
 * @property string $file_name
 * @property string $file_url
 */
class Backup extends Model
{
    use HasFactory;
    protected $table = 'backup';

    protected $fillable = [
        'file_name',
        'file_url'
    ];

    protected $casts = [
        'created_at' => 'datetime'
    ];
}
