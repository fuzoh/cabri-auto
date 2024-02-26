<x-mail::message>
# Confirmation des informations pour le retour des participants

Bonjour {{ $registration->first_name }} {{ $registration->last_name }},

Nous avons bien reçu votre formulaire, voici un récapitulatif des informations indiquées :
- Prénom Nom : {{ $registration->first_name }} {{ $registration->last_name }}
- Email : {{ $registration->email }}
- Téléphone : {{ $registration->phone }}


## Informations pour le retour des participants
Vous avez indiqué que vous ne participerez pas à la journée anniveraires, mais viendrez récupérer les participants suivants :

{{ $registration->participantRecuperation->names }}

Nous avons pris note de ces informations, elles seront transmises à l'équipe qui vous accueillera sur place.
Merci de bien prendre note que :
- Vous êtes responsable de venir récupérer les participants indiqués
- Vous êtes responsable de communiquer avec les parents des éventules participants que vous raméneriez en covoiturage.

Vous recevrez quelques semaines avant le camp un mail de confirmation définitive avec les informations détaillées : Lieux de rdv, horaires...

Nous vous remercions de votre confiance,
Salutations scoutes

L'équipe de coordination du camp de brigade 2024

*En cas de questions, n'hésitez pas a nous contacter à l'adresse [coordination@cabri24.ch](mailto:coordination@cabri24.ch)*
</x-mail::message>
