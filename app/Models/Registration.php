<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'payment_email_sent',
    ];

    public $casts = [
        'form_filled_at' => 'datetime',
        'payment_email_sent' => 'datetime',
    ];

    public $timestamps = false;

    public function ticket(): HasOne
    {
        return $this->hasOne(Ticket::class);
    }

    public function participantRecuperation(): HasOne
    {
        return $this->hasOne(ParticipantRecuperation::class);
    }
}
