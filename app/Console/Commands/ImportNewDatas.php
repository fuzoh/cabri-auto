<?php

namespace App\Console\Commands;

use App\Models\Enums\Location;
use App\Models\Enums\TicketType;
use App\Models\Registration;
use Illuminate\Console\Command;
use Rap2hpoutre\FastExcel\FastExcel;

class ImportNewDatas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-new-datas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import registration data from excel';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $collection = (new FastExcel)->import('inscription.xlsx');
        $collection->each(function ($row) {
            dump($row);
            $r = Registration::create([
                'form_id' => $row['ID'],
                'first_name' => $row['Prénom'],
                'last_name' => $row['Nom'],
                'email' => $row['Adresse e-mail'],
                'phone' => $row['Numéro de téléphone mobile (atteingnable le jour même)'],
                'comment' => $row['Informations supplémentaires, commentaires, remarques :'],
                'form_filled_at' => $row['Completion time'],
            ]);
            if ($row['Je participe à la journée en tant que :'] === 'Je ne participe pas à la journée, mais vient récupérer des participants') {
                $r->participantRecuperation()->create([
                    'names' => $row['Indiquez les noms, prénoms et groupe de tous les enfants que vous allez récupérer. Mettez à la ligne pour chaque personne supplémentaire :'],
                ]);

                return; // Stop here for this type of inscription
            }
            // Manage 4 form cases
            $location = null;
            if ($row['Je participe à la journée en tant que :'] === "Ancien flambeaux (je n'ai pas d'enfant qui participe au camp)") {
                $r->elder()->create([
                    'group' => $row['De quel groupe avez-vous fait partie :'],
                ]);
                $location = Location::fromCity($row["Lieux de départ et d'arrivée en train3"]);
            }
            if ($row['Je participe à la journée en tant que :'] === 'Parent de participant au camp') {
                $r->parentParticipantAtCamp()->create([
                    'get_participant' => $row['Venez-vous récupérer des participants qui terminent le camp louveteaux et/ou lucioles ?'] === 'OUI',
                    'get_in_car' => $row['Est-ce que vous souhaitez récupérer vos enfants en voiture ?'] === 'OUI',
                    'get_other_participant' => $row["Récupérez vous des enfants d'une autre famille ?"] === 'OUI',
                    'names_picked_up' => $row['Indiquez les noms, prénoms et groupe de tous les enfants que vous allez récupérer. Mettez à la ligne pour chaque personne supplémentaire :2'],
                    'names_visited' => $row['Indiquez les noms, prénoms et groupe de vos enfants, que vous venez visiter :'],
                ]);
                dump($r->parentParticipantAtCamp->get_participant);
                if (! $r->parentParticipantAtCamp->get_in_car && $r->parentParticipantAtCamp->get_participant) {
                    $location = Location::fromCity($row["Lieux de départ et d'arrivée en train"]);
                }
            }
            if ($row['Je participe à la journée en tant que :'] === 'Parent de participant mais qui ne sont pas au camp') {
                $r->parentMember()->create([
                    'group' => $row['De quel groupe font partie vos enfants'],
                ]);
                $location = Location::fromCity($row["Lieux de départ et d'arrivée en train2"]);
            }
            if ($row['Je participe à la journée en tant que :'] === 'Amis, connaissance') {
                $r->friend()->create();
                $location = Location::fromCity($row["Lieux de départ et d'arrivée en train4"]);
            }

            $r->ticket()->create([
                'type' => $row["Quelle est votre tranche d'age"] === 'Billet adulte (plus de 16 ans)' ? TicketType::Adult : TicketType::Child,
                'location' => $location,
            ]);
            if ($row['Viendrez-vous accompagné à la journée ?'] === 'OUI') {
                $r->ticket->companion()->create([
                    'how_many_adults' => $row["Combien d'accompagnant adulte a prévoir en plus de vous ?"],
                    'how_many_children' => $row["Combien d'accompagnant enfant à prévoir en plus de vous"],
                    'names' => $row["Merci d'indiquer les prénoms et noms des accompagnants, séparés par des virgules :"],
                ]);
            }
        });
    }
}
