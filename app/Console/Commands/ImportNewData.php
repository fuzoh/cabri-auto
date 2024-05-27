<?php

namespace App\Console\Commands;

use App\Models\Enums\Location;
use App\Models\Enums\RegistrationType;
use App\Models\Enums\TicketType;
use App\Models\Enums\TransportType;
use App\Models\Import;
use App\Models\ImportRowFail;
use App\Models\Registration;
use App\Models\Ticket;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Rap2hpoutre\FastExcel\FastExcel;

class ImportNewData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-new-data';

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
        $collection = (new FastExcel)->import('inscriptions.xlsx');

        // Create an import record for error tracking
        $i = Import::create([
            'imported_file' => $collection->toJson()
        ]);

        $bar = $this->output->createProgressBar(count($collection));
        $bar->start();

        $collection->each(function ($row) use ($i, $bar) {
            //dump($row);
            try {
                Registration::where('form_id', $row['ID'])->firstOr(function () use ($row) {
                    DB::transaction(function () use ($row) {
                        $r = Registration::create([
                            'form_id' => $row['ID'],
                            'first_name' => Str::trim($row['Prénom']),
                            'last_name' => Str::trim($row['Nom']),
                            'email' => Str::trim($row['Adresse e-mail']),
                            'phone' => $row['Numéro de téléphone mobile (atteignable le jour même)'],
                            'comment' => $row['Informations supplémentaires, commentaires, remarques :'],
                            'type' => RegistrationType::fromFromString($row['Vous êtes :']),
                            'form_filled_at' => $row['Completion time'],
                        ]);

                        // Case 1 -> only participant recuperation
                        if ($row["Quel type d'inscription souhaitez-vous effectuer ?"] === "C - Je ne participe pas à la journée mais viens récupérer des participants/responsables") {
                            $r->participantRecuperation()->create([
                                'names' => $row["Indiquez les noms, prénoms et groupes de tous les participants/responsables que vous allez récupérer. Indiquez chaque personne supplémentaire sur une nouvelle ligne avec une virgule :"]
                            ]);
                        } else {
                            // Case 2 -> only participation to the day
                            $ticket = new Ticket();
                            if ($row["Quel type d'inscription souhaitez-vous effectuer ?"] === "B - Je viens uniquement vivre la journée, je n'ai pas de participants/responsables à récupérer") {
                                if ($row["Je "] === "Possède un AG et viendrai de manière autonome via les correspondances classiques.") {
                                    $ticket->transport_type = TransportType::Autonomous;
                                    $ticket->location_autonomous = $row["Indiquez votre ville de départ"];
                                } elseif ($row["Je "] === "Souhaite venir en train via les trains spéciaux organisés.") {
                                    if($row["Lieu de départ et d'arrivée en train"] === "J'habite dans la région du camp (Rossinière, Château d'Oex, Rougemont et plus haut) et viens à pied ou via les horaires standards de train" || $row["Lieu de départ et d'arrivée en train"] === "J'habite dans la région du camp (Rossinière, Château d'Oex, Rougemont et plus haut) et viens à pied ou en vélo") {
                                        $ticket->transport_type = TransportType::LocalResident;
                                    } else {
                                        $ticket->transport_type = TransportType::SpecialTrain;
                                        $ticket->transport_location = Location::fromCityString(
                                            $row["Lieu de départ et d'arrivée en train"]
                                        );
                                    }
                                } else {
                                    throw new \Exception("Unknown transport type for Je");
                                }
                            }

                            // Case 3 -> participant recuperation and participation to the day
                            if ($row["Quel type d'inscription souhaitez-vous effectuer ?"] === "A - Je viens vivre la journée et, au passage, récupérer des participants/responsables") {
                                $r->participantRecuperation()->create([
                                    'names' => $row["Indiquez les noms, prénoms et groupes de tous les participants/responsables que vous allez récupérer. Indiquez chaque personne supplémentaire sur une nouvelle ligne avec une virgule :2"]
                                ]);

                                if ($row["Est-ce que vous souhaitez récupérer ces personnes en voiture ? (le prix du parking est de CHF 10.- par voiture)"] === "OUI, en voiture") {
                                    $ticket->transport_type = TransportType::Car;
                                } elseif ($row["Est-ce que vous souhaitez récupérer ces personnes en voiture ? (le prix du parking est de CHF 10.- par voiture)"] === "NON, j'utiliserai les trains organisés") {
                                    if($row["Lieu de départ et d'arrivée en train"] === "J'habite dans la région du camp (Rossinière, Château d'Oex, Rougemont et plus haut) et viens à pied ou via les horaires standards de train" || $row["Lieu de départ et d'arrivée en train"] === "J'habite dans la région du camp (Rossinière, Château d'Oex, Rougemont et plus haut) et viens à pied ou en vélo") {
                                        $ticket->transport_type = TransportType::LocalResident;
                                    } else {
                                        $ticket->transport_type = TransportType::SpecialTrain;
                                        $ticket->transport_location = Location::fromCityString(
                                            $row["Lieu de départ et d'arrivée en train"]
                                        );
                                    }
                                } else {
                                    throw new \Exception("Unknown transport type for participant recuperation");
                                }
                            }

                            // Accomapgnment
                            if ($row["Serez-vous accompagné-e pour cette journée ?"] === "OUI") {
                                $ticket->baby_count = $row["Combien d'accompagnants de moins de 6 ans, en plus de vous ?"];
                                $ticket->adult_count = $row["Combien d'accompagnants de plus de 6 ans, en plus de vous ?"];
                                $ticket->companion_names = $row["Indiquez les prénoms et noms des accompagnants, séparés par des virgules :"];
                            }

                            $r->ticket()->save($ticket);
                        }
                    });
                });
            } catch (\Exception $e) {
                dump($e->getMessage());
                $i->importRowFail()->create([
                    'failed_form_row_id' => $row['ID'],
                    'exception' => $e->getMessage()
                ]);
            } finally {
                $bar->advance();
            }
        });

        $bar->finish();
    }
}
