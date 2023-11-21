<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $ip_address
 */
class AccessList extends Model
{
    use HasFactory;
    public $table = 'access_list';
    public $timestamps = false;
    protected $fillable = [
        'ip_address'
    ];
}
