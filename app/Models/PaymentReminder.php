<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentReminder extends Model
{
    public $fillable = [
        'registration_id',
        'sent_at',
    ];

    public $casts = [
        'sent_at' => 'datetime',
    ];

    public $timestamps = false;

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }
}
