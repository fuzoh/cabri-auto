<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Companion
 *
 * @property int $id
 * @property int $how_many_adults
 * @property int $how_many_children
 * @property string $names
 * @property int $ticket_id
 * @method static \Illuminate\Database\Eloquent\Builder|Companion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Companion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Companion query()
 * @method static \Illuminate\Database\Eloquent\Builder|Companion whereHowManyAdults($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Companion whereHowManyChildren($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Companion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Companion whereNames($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Companion whereTicketId($value)
 */
	class Companion extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Elder
 *
 * @property int $id
 * @property string $group
 * @property int $registration_id
 * @method static \Illuminate\Database\Eloquent\Builder|Elder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Elder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Elder query()
 * @method static \Illuminate\Database\Eloquent\Builder|Elder whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Elder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Elder whereRegistrationId($value)
 */
	class Elder extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ParentMember
 *
 * @property int $id
 * @property string $group
 * @property int $registration_id
 * @method static \Illuminate\Database\Eloquent\Builder|ParentMember newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParentMember newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParentMember query()
 * @method static \Illuminate\Database\Eloquent\Builder|ParentMember whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParentMember whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParentMember whereRegistrationId($value)
 */
	class ParentMember extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ParentParticipantAtCamp
 *
 * @property int $id
 * @property bool $get_participant
 * @property bool $get_in_car
 * @property bool $get_other_participant
 * @property string|null $names_visited
 * @property string|null $names_picked_up
 * @property int $registration_id
 * @method static \Illuminate\Database\Eloquent\Builder|ParentParticipantAtCamp newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParentParticipantAtCamp newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParentParticipantAtCamp query()
 * @method static \Illuminate\Database\Eloquent\Builder|ParentParticipantAtCamp whereGetInCar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParentParticipantAtCamp whereGetOtherParticipant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParentParticipantAtCamp whereGetParticipant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParentParticipantAtCamp whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParentParticipantAtCamp whereNamesPickedUp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParentParticipantAtCamp whereNamesVisited($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParentParticipantAtCamp whereRegistrationId($value)
 */
	class ParentParticipantAtCamp extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ParticipantRecuperation
 *
 * @property int $id
 * @property string $names
 * @property int $registration_id
 * @method static \Illuminate\Database\Eloquent\Builder|ParticipantRecuperation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParticipantRecuperation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParticipantRecuperation query()
 * @method static \Illuminate\Database\Eloquent\Builder|ParticipantRecuperation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParticipantRecuperation whereNames($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParticipantRecuperation whereRegistrationId($value)
 */
	class ParticipantRecuperation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Registration
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $form_filled_at
 * @property int $form_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string|null $comment
 * @property-read \App\Models\Elder|null $elder
 * @property-read \App\Models\ParentMember|null $parentMember
 * @property-read \App\Models\ParentParticipantAtCamp|null $parentParticipantAtCamp
 * @property-read \App\Models\ParticipantRecuperation|null $participantRecuperation
 * @property-read \App\Models\Ticket|null $ticket
 * @method static \Illuminate\Database\Eloquent\Builder|Registration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Registration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Registration query()
 * @method static \Illuminate\Database\Eloquent\Builder|Registration whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registration whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registration whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registration whereFormFilledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registration whereFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registration whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registration wherePhone($value)
 */
	class Registration extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Ticket
 *
 * @property int $id
 * @property \App\Models\Enums\TicketType $type
 * @property \App\Models\Enums\Location $location
 * @property int $registration_id
 * @property-read \App\Models\Companion|null $companion
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereRegistrationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereType($value)
 */
	class Ticket extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

