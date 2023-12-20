<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $text
 */
class TemplatesList extends Model
{
    use HasFactory;

    protected $table = 'templates_list';

    protected $fillable = [
        'name',
        'text'
    ];


}
