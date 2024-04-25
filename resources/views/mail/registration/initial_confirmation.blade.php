<x-mail::message>

*Ceci est un email automatique, merci de ne pas répondre*

# Confirmation de votre inscription à la journée anniversaire des 60 ans de la Brigade Romande des Flambeaux de l'évangile


Bonjour,

Nous vous confirmons avoir reçu votre inscription à la journée anniversaire de notre camp de brigade. Vous trouvez ci-dessous un récapitulatif
des informations que vous avez indiquées ainsi que les informations pour le paiement.

Merci de nous écrire en cas d'erreur. La réception du paiement confirmera votre inscription.

---

## Informations du preneur :

**Nom, Prénom** : {{ $registration->first_name }} {{ $registration->last_name }}

**Email** : {{ $registration->email }}

**Téléphone** : {{ $registration->phone }}


@if($registration->ticket->baby_count + $registration->ticket->adult_count > 0)

## Vous avez indiqué être accompagné de :

**{{ $registration->ticket->baby_count }}** personnes de moins de 6 ans.

**{{ $registration->ticket->adult_count }}** personnes de plus de 6 ans.

Noms de vous accompagnants :

{{ $registration->ticket->companion_names }}
@else

## Vous avez indiqué venir seul à la journée.
@endif


@if($registration->participantRecuperation)

## Vous avez indiqué que vous repartirez avec les participants suivants à la fin de la journée :

{{ $registration->participantRecuperation->names }}

Nous rappelons qu'ils sont sous votre responsabilité pour le trajet du retour.
@else

## Vous avez indiqué que vous ne repartirez avec aucun participant après la journée
@endif


@if($registration->ticket->transport_type === \App\Models\Enums\TransportType::Car)

## Vous avez indiqué que vous viendrez en voiture.

Les frais d'inscription sont donc de CHF 5.- par participant de plus de 6 ans.<br>
Vous avez indiqué {{ $registration->ticket->adult_count }} adultes.<br>
Le total de finance d'inscription est donc de **{{ $registration->ticket->totalJourneyPrice() }}.- CHF**.

@elseif($registration->ticket->transport_type === \App\Models\Enums\TransportType::SpecialTrain)

## Vous vous déplacerez au moyen des trains spéciaux organisés par le camp.

Vous partirez depuis la gare de : **{{ $registration->ticket->transport_location }}**.<br>
Les informations quant aux horaires de départ vous seront communiquées ultérieurement.

Vous avez indiqué {{ $registration->ticket->adult_count }} participant de plus de 6 ans.<br>
Le tarif pour les personnes de plus de 6 ans est de 5.- pour la journée et 20.- pour le transport.<br>
Le total de votre finance d'inscription est donc de **{{ $registration->ticket->totalPrice() }}.- CHF**.

@elseif($registration->ticket->transport_type === \App\Models\Enums\TransportType::Autonomous)

## Vous avez indiqué que vous et vos accompagnants avez un AG, et viendrez de manière autonome via les lignes de train standard.
Vous partirez depuis : {{ $registration->ticket->location_autonomous }}

Les frais d'inscription sont donc de CHF 5.- par participant de plus de 6 ans.<br>
Vous avez indiqué {{ $registration->ticket->adult_count }} adultes.<br>
Le total de finance d'inscription est donc de **{{ $registration->ticket->totalJourneyPrice() }}.- CHF**.

@elseif($registration->ticket->transport_type === \App\Models\Enums\TransportType::LocalResident)

## Vous avez indiqué que vous habitez dans la région et viendrez de façon autonome.
Veuillez noter qu'il n'y aura pas de places de parc disponibles sur la commune de Rossignère.

Les frais d'inscription sont de CHF 5.- par participant de plus de 6 ans.<br>
Vous avez indiqué {{ $registration->ticket->adult_count }} personnes de plus de 6 ans.<br>
Le total de votre finance d'inscription est donc de **{{ $registration->ticket->totalJourneyPrice() }}.- CHF**.
@endif

## Coordonnées pour le paiement :
IBAN : CH53 8080 8005 8147 5591 2<br>
Nom : Le camp de brigade 2024<br>
Lieux : Chemin de la Maraîche 10, 1802 Corseaux

Vous pouvez aussi utiliser la QR facture en pièce jointe.

Pour rappel, la réception du paiement valide définitivement votre inscription.

---

Nous vous remercions pour votre inscription et nous réjouissons de vous voir lors du camp,


Dans l'intervalle, nos meilleures salutations,

La maîtrise de coordination du camp de brigade.



*En cas de questions [coordination@cabri24.ch](mailto:coordination@cabri24.ch)*
</x-mail::message>
