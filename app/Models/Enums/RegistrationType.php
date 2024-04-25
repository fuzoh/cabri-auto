<?php

namespace App\Models\Enums;

enum RegistrationType: string
{
    case Friend = 'Friend';
    case Parent = 'Parent';
    case Family = 'Family';
    case ScoutFriend = 'ScoutFriend';

    public static function fromFromString(string $type): RegistrationType
    {
        return match ($type) {
            'Connaissances, amis de la Brigade' => self::Friend,
            'Parent direct de participants/responsables du camp' => self::Parent,
            'Famille de participants/responsables du camp' => self::Family,
            'Amis scouts' => self::ScoutFriend,
        };
    }
}
