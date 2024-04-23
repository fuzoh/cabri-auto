<?php

namespace App\Models\Enums;

enum Location: string
{
    case Bienne = 'Bienne';
    case Lausanne = 'Lausanne';
    case Neuchatel = 'Neuchatel';
    case Yverdon = 'Yverdon';
    case Montreux = 'Montreux';
    case Nyon = 'Nyon';
    case Morges = 'Morges';
    case Bulle = 'Bulle';

    public static function fromCityString(string $city): Location
    {
        return match ($city) {
            'Bienne' => self::Bienne,
            'Lausanne' => self::Lausanne,
            'Neuchâtel' => self::Neuchatel,
            'Yverdon' => self::Yverdon,
            'Montreux' => self::Montreux,
            'Nyon' => self::Nyon,
            'Morges' => self::Morges,
            'Bulle' => self::Bulle,
        };
    }
}
