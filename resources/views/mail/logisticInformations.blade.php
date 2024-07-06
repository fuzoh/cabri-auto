<x-mail::message>
# Informations pratiques - Journée anniversaire des 60 ans de la Brigade des Flambeaux

Bonjour, vous recevez cet email car vous êtes inscrits à la journée anniversaire
du camp des 60 ans de la Brigade des Flambeaux.

Vous trouvez ci-dessous les informations pratiques qui correspondent à votre inscription, merci de les lire **attentivement** !

Vous trouvez également en pièce jointe votre inscription pour la journée, il faudra venir avec (soit imprimé au
format papier, soit sur votre téléphone).

<hr>

@if($registration->ticket->transport_type === \App\Models\Enums\TransportType::SpecialTrain)

## Vous êtes inscrit pour venir via les trains spéciaux organisés

Des trains spéciaux ont été organisés depuis la gare que vous avez indiquée. Ces trains vous emmèneront jusqu'à
Rossinière. Il s'agit de trains spécialement affrétés pour nous, vous n'avez pas besoin de billets pour monter dedans,
il vous faut juste votre inscription (en pièce jointe).

Vous avez indiqué que vous partirez depuis la gare de **{{ $registration->ticket->transport_location }}**,
vous pouvez **consulter l'horaire de train allé et retour en pièce jointe**.
- Attention, si vous devez faire un bout de trajet en plus avant la gare de départ indiquée, pensez a le prévoir.
- Attention, les trains spéciaux n'attendront pas les retardataires, veillez à prévoir de l'avance afin de ne pas les louper.
Si vous loupez un des trains spéciaux, nous n'avons aucune solution de remplacement pour votre trajet.

@if($registration->ticket->transport_location === \App\Models\Enums\Location::Bienne)
La partie du trajet entre Bienne et Neuchâtel se fera avec un billet de groupe CFF, un des membres de votre convoi a le billet.
Veuillez observer les affichages pour vous retrouver au bon endroit dans le train.
@endif

Une fois arrivés à Roissignère, veuillez vous présenter au check-in, juste à côté de la gare.

Pour le retour à la fin de la journée, veillez à observer votre horaire en pièce jointe.

@elseif($registration->ticket->transport_type === \App\Models\Enums\TransportType::Car)

## Vous êtes inscrit pour venir en voiture

Vous pouvez arriver à Rossinière au plus tôt à **9h30, et jusqu'à 11h30 maximum !**
Aux entrées du village, il vous faudra suivre les indications des personnes en gilet orange. Ils vous guideront jusqu'aux différents
parkings selon le remplissage. Une fois parqué, il faudra vous rendre au check-in à pied (voir plan en annexe).

La journée se terminera à 16h! Attention, vous devrez partir tous en même temps, en effet, les voitures seront pour la majorité
parquée collée les unes aux autres, certains ne pourront donc pas partir tant que les autres voitures ne seront pas parties.

@elseif($registration->ticket->transport_type === \App\Models\Enums\TransportType::LocalResident)

## Vous vous êtes inscrit comme venant de la région

Vous avez indiqué dans le formulaire que vous habitez dans la région. Pour rappel, il était précisé dans le formulaire qu'il ne faut pas
emprunter les trains, mais venir à pied ou en vélo.
La raison est que vous serez plus de 150 de la région, et que nous nous sommes engagés auprès
des compagnies ferroviaires pour ne pas surcharger les trains qui sont déjà bien pleins a cette période.

Merci donc de venir au maximum à pied ou en vélo. Si vous n'avez pas le choix de prendre le train, le billet est a votre
charge, et nous vous remercions de ne pas utiliser de places assisses sur ce petit trajet. Nous tenons à maintenir
une bonne image des Flambeaux auprès des compagnies ferroviaires qui ont été très arrangeantes avec nous.

Vous pouvez arriver dès **9h30, et jusqu'à 11h30 maximum !**, la journée prendra fin vers 16h.

@elseif($registration->ticket->transport_type === \App\Models\Enums\TransportType::Autonomous)

## Vous êtes inscrit comme venant en train avec votre AG

Vous avez indiqué dans votre inscription que vous viendrez en train "normal" avec votre AG.
Il est important que vous empruntiez les lignes standard CFF, merci de ne pas utiliser
les trains spéciaux prévus pour les autres inscriptions à la journée.

Il est de votre responsabilité de planifier votre trajet.
Vous êtes attendus à Rossinière au plus tôt à **9h30, au plus tard à 11h30**.
La journée se terminera vers 16h.

@endif

<hr>

## Check in sur place

Une fois arrivés a Rossinière, il vous faudra vous rendre, **vous et les personnes qui sont annoncées dans votre inscription** au check-in.
Vous y recevrez les informations pratiques et votre inscription sera contrôlée.

Le check in se trouve [juste au sud de la gare de Rossinière](https://maps.app.goo.gl/yVAQW9UXd8FkAVxe7) (voir plan en annexe).
Une fois passé le check-in, vous pourrez vous rendre sur le terrain de camp pour la journée, en suivant les instructions des staffs sur place.

**ATTENTION : Merci de ne pas venir directement sur le terrain via un autre accès ! Il sera impossible d'y accéder.
Pour des raisons de sécurité, nous devons vous voir au complet au check-in avant d'accéder au camp.**

<hr>

## Autres informations pratiques

- Pensez à vous munir d'un pique-nique pour le midi
- Des stands de boissons seront disponibles sur place
- Des stands de petits snacks et desserts seront disponibles sur place
- Les enfants qui vous accompagnent sont sous votre responsabilité
- Les chiens doivent être tenus en laisse toute la journée

<hr>

Toute l'équipe de coordination du camp se réjouit de vous retrouver pour cette journée d'accomplissement, après 3 ans de préparation.

Nous vous remercions pour votre lecture.

D'ici au 20, excellente continuation.

L'équipe de coordination du camp.
</x-mail::message>
