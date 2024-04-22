<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companion extends Model
{
    public $fillable = [
        'baby_companion_count',
        'adult_companion_count',
    ];
}
