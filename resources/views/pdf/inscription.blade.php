<h1>Inscription Journée Anniversaire des 60 ans de la brigade des Flambeaux</h1>

<p><i>Merci de vous munir de cette feuille d'inscription le jour même</i></p>

<h2>Preneur de l'inscription</h2>

<p>Nom : <strong>{{ \Illuminate\Support\Str::upper($registration->last_name) }}</strong> {{$registration->first_name}}</p>

<p>Email : {{$registration->email}}</p>

<p>Téléphone : {{$registration->phone}}</p>

<p><strong><i>Numéro unique : {{$registration->payment_id}}</i></strong></p>

<hr style="margin-top: 10px; margin-bottom: 10px">

<h2>Type d'inscription</h2>

<p>{{$registration->ticket->transport_type->getFriendlyName()}}</p>

@if($registration->ticket->transport_type === \App\Models\Enums\TransportType::SpecialTrain)
    <p>Gare de départ : {{$registration->ticket->transport_location}}</p>
@endif

<hr style="margin-top: 10px; margin-bottom: 10px">

<h2>Nombre de personnes et accompagnants</h2>

<p>Adultes: {{$registration->ticket->totalAdultPassengers()}}</p>
<p>Enfants moins de 6 ans: {{$registration->ticket->baby_count }}</p>

<p><strong>Nom des accompagnants :</strong></p>
<p>{{$registration->ticket->companion_names}}</p>
