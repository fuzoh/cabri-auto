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

    public function elder(): HasOne
    {
        return $this->hasOne(Elder::class);
    }

    public function parentMember(): HasOne
    {
        return $this->hasOne(ParentMember::class);
    }

    public function parentParticipantAtCamp(): HasOne
    {
        return $this->hasOne(ParentParticipantAtCamp::class);
    }

    public function participantRecuperation(): HasOne
    {
        return $this->hasOne(ParticipantRecuperation::class);
    }

    public function friend(): HasOne
    {
        return $this->hasOne(Friend::class);
    }
}
