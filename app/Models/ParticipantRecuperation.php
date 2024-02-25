<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipantRecuperation extends Model
{
    public $fillable = [
        'names',
    ];

    public $timestamps = false;
}
