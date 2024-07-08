<x-mail::message>

*Ceci est un email automatique, merci de ne pas répondre*

# Informations pratiques - Récupération de vos enfants le 20 juillet à Rossinière

Bonjour, vous recevez cet e-mail, car vous êtes inscrits pour venir récupérer
des participants au camp des 60 ans de la Brigade des Flambeaux le 20 juillet en fin de journée.

Voici les informations pratiques :

Vous êtes attendus le samedi **20 juillet entre 17h30 et 18h** à la gare de [Rossinière VD](https://maps.app.goo.gl/qpezx4owitYTRP1W8) (suivre les panneaux routiers et les indications des gilets orange sur place).
Une fois sur place, veuillez vous annoncer aux responsables présents, et leur indiquer les participants
que vous venez récupérer, afin qu'ils vous annoncent aux bons responsables.

Pour rappel, vous avez indiqué que vous récupéreriez les personnes suivantes :

{{ $registration->participantRecuperation->names }}

Veuillez prendre note que vous ne pourrez rester sur place que le temps de charger, il faudra rapidement libérer la place.
De plus, vous n'aurez pas l'occasion de visiter le terrain de camp.

Le numéro unique de votre inscription vous sera peut-être demandé : **{{ $registration->uuidPart() }}**

Informations du preneur : **{{ $registration->email }} - {{ $registration->last_name }} {{ $registration->first_name }}**

En nous réjouissant de vous voir le 20,

Meilleures salutations.

L'équipe de coordination du camp.

*En cas de questions [coordination@cabri24.ch](mailto:coordination@cabri24.ch)*
</x-mail::message>
