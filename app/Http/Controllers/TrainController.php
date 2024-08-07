<?php

namespace App\Http\Controllers;

use App\Models\Enums\TransportType;
use App\Models\Registration;
use App\Models\Ticket;
use Inertia\Inertia;

class TrainController extends Controller
{
    public function index()
    {
        /*    return Inertia::render('Welcome', [
                'canLogin' => Route::has('login'),
                'canRegister' => Route::has('register'),
                'laravelVersion' => Application::VERSION,
                'phpVersion' => PHP_VERSION,
            ]);*/
        // 140 places auto

        // 130 personnes a bienne
        // 2100
        // 21350

        // bulle ross -> 972
        // P max = 362 + 418 + 200 + 192 = 1302
        // 23450 / 1200 = 22

        // cas idéal (tout est plein
        // Scénatio tout le monde est la et bienne passe par neuch -> 20.92
        // Scénario tout est plein, bienne dans car -> 20.059
        // Pire scénario a 22.- la journée  -> 1114 personnes
        $trasport_type = Ticket::all()
            ->groupBy('transport_type');
        $special_train = $trasport_type->get('special_train');
        $by_city = $special_train
            ->groupBy('transport_location');

        $total_by_type = $trasport_type->map(function ($t) {
            return $t->reduce(function ($carry, $item) {
                return $carry + $item->totalPassengers();
            }, 0);
        });
        $total_by_city = $by_city->map(function ($t) {
            return $t->reduce(function ($carry, $item) {
                return $carry + $item->totalAdultPassengers();
            }, 0);
        });
        $total_by_city_with_baby = $by_city->map(function ($t) {
            return $t->reduce(function ($carry, $item) {
                return $carry + $item->totalPassengers();
            }, 0);
        });
        $total_by_city_return_with_parts = $by_city->map(function ($t) {
            return $t->map(function (Ticket $ticket) {
                $partRecuperation = 0;
                if ($ticket->registration->participantRecuperation) {
                    $partRecuperation = count(explode("\n", $ticket->registration->participantRecuperation->names));
                }
                return $ticket->totalPassengers() + $partRecuperation;
            })->reduce(fn ($c, $t) => $c + $t);
        });

        $car_type_count = Ticket::where('transport_type', TransportType::Car)
            ->count();

        $onlyPartRecuperation = Registration::whereHas('participantRecuperation')->doesntHave('ticket')->get();
        $total_only_part_recuperation = count($onlyPartRecuperation);

        return Inertia::render('TrainCapacity', [
            'totalByCity' => $total_by_city,
            'totalByCityWithBaby' => $total_by_city_with_baby,
            'totalByCityReturnWithParts' => $total_by_city_return_with_parts,
            'totalByType' => $total_by_type,
            'totalOnlyPartRecuperation' => $total_only_part_recuperation,
            'carTypeCount' => $car_type_count,
        ]);
    }
}
