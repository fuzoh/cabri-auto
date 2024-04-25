<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ParticipantRecuperation extends Model
{
    public $fillable = [
        'names',
    ];

    public $timestamps = false;

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }
}
