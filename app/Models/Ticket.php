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

    const JOURNEY_PRICE = 5;
    const TRANSPORT_PRICE = 20;

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

    public function totalTransportPrice(): int
    {
        return (1 + $this->adult_count) * self::TRANSPORT_PRICE;
    }

    public function totalJourneyPrice(): int
    {
        return (1 + $this->adult_count) * self::JOURNEY_PRICE;
    }

    public function totalPrice(): int
    {
        return $this->totalTransportPrice() + $this->totalJourneyPrice();
    }

    public function totalAdultPassengers(): int
    {
        return 1 + $this->adult_count;
    }

    public function totalPassengers(): int
    {
        return 1 + $this->adult_count + $this->baby_count;
    }

    public function price(): int
    {
        if ($this->transport_type === TransportType::Car) {
            return $this->totalJourneyPrice() + 10;
        } elseif ($this->transport_type === TransportType::SpecialTrain) {
            return $this->totalPrice();
        } elseif ($this->transport_type === TransportType::Autonomous) {
            return $this->totalJourneyPrice();
        } elseif ($this->transport_type === TransportType::LocalResident) {
            return $this->totalJourneyPrice();
        }
        return 0;
    }
}
