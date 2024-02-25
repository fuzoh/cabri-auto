<?php

namespace App\Models\Enums;

enum Location: string
{
    case Bienne = 'Bienne';
    case Lausanne = 'Lausanne';
    case Neuchatel = 'Neuchatel';
    case Yverdon = 'Yverdon';
    case Vevey = 'Vevey';

    public static function fromCity(string $city): Location
    {
        return match ($city) {
            'Bienne' => self::Bienne,
            'Lausanne' => self::Lausanne,
            'Neuchâtel' => self::Neuchatel,
            'Yverdon' => self::Yverdon,
            'Vevey' => self::Vevey,
        };
    }
}
