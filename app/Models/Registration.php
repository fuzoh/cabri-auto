<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    public $fillable = [
        'form_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'comment',
        'form_filled_at',
    ];

    public $casts = [
        'form_filled_at' => 'datetime',
    ];

    public $timestamps = false;
}
