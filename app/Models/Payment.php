<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    public $fillable = [
        'payment_date',
        'imported_at',
        'data_message',
        'amount',
    ];

    public $casts = [
        'payment_date' => 'datetime',
        'imported_at' => 'datetime',
    ];

    public function registration(): HasOne
    {
        return $this->hasOne(Registration::class, 'payment_confirmation_id');
    }
}
