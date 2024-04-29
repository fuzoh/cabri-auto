<?php

namespace App\Models;

use App\Models\Enums\RegistrationType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Registration extends Model
{
    use HasUuids;

    public function uniqueIds(): array
    {
        return ['payment_id'];
    }

    public function uuidPart()
    {
        return substr($this->payment_id, 0, 8);
    }

    public $fillable = [
        'form_id',
        'first_name',
        'last_name',
        'email',
        'type',
        'phone',
        'comment',
        'form_filled_at',
        'payment_email_sent',
    ];

    public $casts = [
        'form_filled_at' => 'datetime',
        'payment_email_sent' => 'datetime',
        'type' => RegistrationType::class,
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
