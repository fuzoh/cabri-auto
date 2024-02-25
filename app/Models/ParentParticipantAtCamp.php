<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParentParticipantAtCamp extends Model
{
    public $fillable = [
        'get_participant',
        'get_in_car',
        'get_other_participant',
        'names',
    ];

    public $casts = [
        'get_participant' => 'boolean',
        'get_in_car' => 'boolean',
        'get_other_participant' => 'boolean',
    ];

    public $timestamps = false;
}
