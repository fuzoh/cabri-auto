<?php

namespace App\Models;

use App\Models\Enums\Location;
use App\Models\Enums\TicketType;
use App\Models\Enums\TransportType;
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
        'transport_type' => TransportType::class,
        'location' => Location::class,
    ];

    public $timestamps = false;

    public function companion(): HasOne
    {
        return $this->hasOne(Companion::class);
    }
}
