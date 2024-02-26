<x-mail::message>
# Confirmation d'inscription à la journée anniversaire

Bonjour {{ $registration->first_name }} {{ $registration->last_name }},

Nous avons bien reçu les informations

## Récapitulatif de l'inscription

Preneur : {{ $registration->first_name }} {{ $registration->last_name }}
Email : {{ $registration->email }}
Téléphone : {{ $registration->phone }}
@if($registration->participantRecuperation)
    Vous avez indiqué que vous ne participerez pas à la journée, mais viendrez récupérer les participants suivants :
    {{ $registration->participantRecuperation->names }}
@endif

</x-mail::message>
