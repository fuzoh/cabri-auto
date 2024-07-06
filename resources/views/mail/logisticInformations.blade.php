<x-mail::message>
# Information pratiques pour la journée anniversaire des flambeaux le 20 juillet

Bonjour, si vous recevez cet email, vous êtes donc inscrits à la journée anniversaire
du camp des 60ans de la Brigade des Flambeaux.

Vous trouvez ci dessous les informations pratiques qui correspondent a votre inscription, merci de les lire **attentivement** !

Vous trouvez également en pièce jointe votre inscription pour la journée, il faudra venir avec (soit imprimé au
format papier, soit sur votre téléphone).

@if($registration->ticket->transport_type === \App\Models\Enums\TransportType::SpecialTrain)

## Vous êtes inscrit pour venir via les trains spéciaux

Des trains spéciaux ont été organisés depuis la gare que vous avez indiquée. Ces trains vous emmeneront jusqu'à
Rossignère. Il s'agit de trains spécialement affrétés pour nous, vous n'avez pas besoin de billets pour monter dedans,
il vous faut juste votre inscription (en pièce jointe).

Vous avez indiqué que vous partirez depuis la gare de **{{ $registration->tickez->transport_location }}**,
vous pouvez consulter l'horaire de train allé et retour en pièce jointe.
Attention, si vous devez faire un bout de trajet en plus depuis la gare indiquée, c'est à vous de le prévoir.
Attention, ces trains spéciaux n'attenderont pas les retardataires, veillez à prévoir de l'avance afin de ne pas les louper.
Si vous loupez un des trains spécial, nous n'avons aucunne solution de remplacemnt pour votre trajet.

Une fois arrivés a Roissignère, veuillez vous présenter au check-in, juste a coté de la gare.

@elseif($registration->ticket->transport_type === \App\Models\Enums\TransportType::Car)

## Vous êtes inscrit pour venir en voiture

Vous pouvez arriver a Rossignère au plus tôt à 9h30, et jusqu'à 11h maximum !
Aux entrées du village, il vous faudra suivre les indications des personnes en gilet Jaunes. Il vous guideront jusqu'au différents
parkings selon le remplissage. Une fois parqué, il faudra vous rendre au check-in a pied (voir plan en annexe).
Une fois le check-in passé, vous pourrez suivre les indicaiton pour vous rendre au terrain de camp.

La journée se terminera à 15h45 ! Attention, vous devrez partir tous en même temps, en effet, les voitures seront pour la majorités
parquées collées les une aux autres, certains ne pourront donc pas partir tant que les autres voitures ne seront pas parties.

@elseif($registration->ticket->transport_type === \App\Models\Enums\TransportType::LocalResident)

## Vous êtes inscrit comme venant de la région

Vous avez indiqué dans le formulaire que vous habitez dans la région. Pour rappel, il était précisé dans le formulaire qu'il ne faut pas
emprunter les trains mais venir a pied ou en vélo. La raison est que vous serez plus de 155, et que nous nous sommes engagés auprès
des compagnies férovières pour ne pas surcharger les trains qui sont déjà bien pleins a cette prériode.

Merci donc de venir au maximum a pied ou en vélo. Si vous n'avez pas le choix de prendre le train, le billet est a votre
charge, et nous vous remercions de ne pas utiliser de places assisses sur ce petit trajet. Nous tenons a maintenir
une bonne image des Flambeaux auprès des compagnies férovières qui ont été trés arrangeantes avec nous.

@elseif($registration->ticket->transport_type === \App\Models\Enums\TransportType::Autonomous)

## Vous êtes inscrit comme venant en train avec votre AG

Vous avez indiqué dans votre inscription que vous viendrez en "normal" avec votre AG.
Il est important que vous empruntiez les lignes standard CFF et MOB, merci de ne pas utiliser
les trains spéciaux prévus pour les autres inscriptions.

Il est de votre responsabilité de planifier votre trajet.
Vous êtes attendus a Rossinière au plus tôt à 9h30, au plus tard à 11h.
La journée se terminera à 15h45.

@endif

## Check in sur place

Une fois arrivés a Rossinière, il vous faudra vous rendre, **vous et les personnes qui vous accompagnent** au check-in.
Vous y recevrez les informations pratiques et votre inscription sera controllée.
Le check in se trouve juste au sud de la gare de Rossignère (voir plan en annexe).
Une fois passé le check-in, vous pourrez vous rendre sur le terrain de camp pour la journée, en suivant les instructions des membres sur place.

**ATTENTION : Merci de ne pas venir directement sur le terrain via un autre accès ! Il sera impossible d'y accéder.
Pour des raisons de sécurité, nous devons vous voir au complet au check-in avant d'accéder au camp.**

## Autres informations pratiques

- Pensez a vous munir d'un pique nique pour le midi
- Des stands de boissons seront disponibles sur place
- Des stands de petit snacks et desserts seront disponible sur place
- Les enfants qui vous accompagnent sont sous votre responsabilité
- Les chiens doivent être tenus en laises toute la journée


Toute l'équipe de coordination du camp se réjouis de vous retrouver pour cette journée accomplissement, après 3 ans de préparation.

Nous vous remercions d'avance pour votre rigeur a propos des instructions pratiques indiquées plus haut.

D'ici au 20, excellente continuation.

L'équipe de coordination du camp.
</x-mail::message>
