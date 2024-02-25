<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Companion extends Model
{
    public $fillable = [
        'how_many_adults',
        'how_many_children',
        'names',
    ];

    public $casts = [
        'how_many_adults' => 'integer',
        'how_many_children' => 'integer',
    ];

    public $timestamps = false;
}
