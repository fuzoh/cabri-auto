<?php

namespace App\Models\Enums;

enum TransportType: string
{
    case SpecialTrain = 'special_train';
    case Car = 'car';
    case Autonomous = 'autonomous';
    case LocalResident = 'local_resident';

    public function getFriendlyName(): string
    {
        return match ($this) {
            self::Car => 'Voyage en voiture',
            self::SpecialTrain => 'Voyage en train spécial',
            self::Autonomous => 'Voyage en train autonome avec AG',
            self::LocalResident => 'Habitant de la région, sans transport',
        };
    }
}
