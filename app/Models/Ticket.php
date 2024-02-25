<?php

namespace App\Models;

use App\Models\Enums\Locations;
use App\Models\Enums\TicketType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ticket extends Model
{
    public $fillable = [
        'type',
        'location',
    ];

    public $casts = [
        'type' => TicketType::class,
        'location' => Locations::class,
    ];

    public $timestamps = false;

    public function companion(): HasOne
    {
        return $this->hasOne(Companion::class);
    }
}
