<?php

namespace App\Models;

use App\Models\Enums\Location;
use App\Models\Enums\TicketType;
use App\Models\Enums\TransportType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ticket extends Model
{
    public $fillable = [
        'transport_type',
        'transport_location',
        'location_autonomous',
        'baby_count',
        'adult_count',
        'companion_names'
    ];

    public $casts = [
        'transport_type' => TransportType::class,
        'transport_location' => Location::class,
    ];

    public $timestamps = false;

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }
}
