<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentMember extends Model
{
    public $fillable = [
        'group',
    ];

    public $timestamps = false;
}
