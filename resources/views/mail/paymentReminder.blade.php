<x-mail::message>

*Ceci est un email automatique, merci de ne pas répondre*

# Rappel de paiement - Journée anniversaire des 60 ans de la Brigade Romande des Flambeaux de l'évangile

Bonjour,

Vous avez récemment effectué une inscription à la journée anniversaire de notre camp de brigade.<br>
Nous vous en remercions. À ce jour nous n'avons pas encore reçu votre paiement.
- Si cela est dû à un oubli, nous vous remercions de bien vouloir effectuer le paiement dans de brefs délais.<br>
- Si vous avez effectué le paiement hier ou aujourd'hui, vous pouvez ignorer ce message.<br>
- Si vous avez bien fait le paiement, merci de bien vouloir nous envoyer une copie du justificatif de virement,
afin que nous pussions retrouver le paiement correspondant dans notre système.

Pour rappel, vous avez complété votre inscription le {{ $registration->form_filled_at->format('d.m.Y') }}, au nom de {{$registration->first_name }} {{ $registration->last_name }}, email : {{ $registration->email }}.<br>
Vous avez reçu le mail de confirmation le {{ $registration->payment_email_sent->format('d.m.Y') }}.
Le montant attendu est de CHF {{ $registration->ticket->price() }}.-.<br>
Vous trouvez une copie de la facture originale en pièce jointe.

En cas d'erreur ou de question, n'hésitez pas à nous contacter à l'adresse [coordination@cabri24.ch](mailto:coordination@cabri24.ch).

Nous vous remercions pour votre réactivité et nous réjouissons de vous retrouver lors de notre journée anniversaire.

Avec nos meilleures salutations,
La maîtrise de coordination du camp de brigade.

*P.S. Quelques jours après avoir effectué le paiement, vous recevrez un email de confirmation de paiement.*

*En cas de questions [coordination@cabri24.ch](mailto:coordination@cabri24.ch)*
</x-mail::message>
