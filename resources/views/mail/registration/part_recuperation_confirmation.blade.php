<x-mail::message>

*Ceci est un email automatique, merci de ne pas répondre*

# Confirmation des informations pour la récupération de vos particiapants à la fin du camp de brigade


Bonjour,

Nous vous confirmons avoir reçu les informations pour le retour de vos participants au camp de brigade.
Vous avez indiqué dans le formulaire que vous ne **participerez pas à la journée anniversaire**, mais **viendrez uniquement récupérer
vos participants à la fin de la journée** du **20 juillet 2024**.

---

Voici un récapitulatif des informations que vous avez indiqué:

**Nom, Prénom** : {{ $registration->first_name }} {{ $registration->last_name }}

**Email** : {{ $registration->email }}

**Téléphone** : {{ $registration->phone }}


**Participants que vous récupérerez :**

{{ $registration->participantRecuperation->names }}

---

Nous vous rappelons que vous n'aurez pas le temps de visiter le camp. La durée d'arrêt sur le parking ne pouvant être que de quelques minutes.

Vous recevrez les horaires précis juste avant le camp, la plage horaire sera vraisemblablement entre 16h30 et 18h.

Nous vous remercions pour votre inscription et nous réjouissons de vous voir lors du camp,


Dans l'intervalle, nos meilleures salutations,

La maîtrise de coordination du camp de brigade.



*En cas de questions [coordination@cabri24.ch](mailto:coordination@cabri24.ch)*
</x-mail::message>
