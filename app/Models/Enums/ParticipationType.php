<?php

namespace App\Models\Enums;

enum ParticipationType: string
{
    case ParentParticipantInCamp = 'parent_participant_in_camp';
    case ParentParticipantNotInCamp = 'parent_participant_not_in_camp';
    case Elder = 'elder';
    case ParticipantRecuperation = 'participant_recuperation';
}
