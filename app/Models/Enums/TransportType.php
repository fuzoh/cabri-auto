<?php

namespace App\Models\Enums;

enum TransportType: string
{
    case SpecialTrain = 'special_train';
    case Car = 'car';
    case Autonomous = 'autonomous';
}
