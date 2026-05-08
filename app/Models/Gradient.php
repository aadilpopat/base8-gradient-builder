<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gradient extends Model
{
    protected $fillable = [
        'user_id',
        'name', 
        'type',
        'angle',
        'color_1',
        'color_2',
    ];
}
